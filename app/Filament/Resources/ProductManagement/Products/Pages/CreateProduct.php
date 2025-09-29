<?php

namespace App\Filament\Resources\ProductManagement\Products\Pages;

use App\Enums\ProductType;
use App\Enums\ProductState;
use Illuminate\Support\Str;
use Filament\Actions\Action;
use Filament\Schemas\Schema;
use App\Helpers\SerialHelper;
use App\Models\Core\Procedure;
use App\Models\Products\Product;
use Illuminate\Http\UploadedFile;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Illuminate\Support\Facades\Blade;
use App\Models\Products\ProductFolder;
use App\Models\Products\ProductVariant;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Components\Fieldset;
use App\Models\Products\Groups\ProductGroup;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Infolists\Components\RepeatableEntry;
use App\Models\Products\Categories\ProductCategory;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use App\Filament\Resources\ProductManagement\Products\ProductResource;

class CreateProduct extends Page
{
    use InteractsWithSchemas;
    protected static string $resource = ProductResource::class;

    protected string $view = 'volt-livewire::filament.resources.product-management.products.pages.create-product';
    protected static ?string $title = 'ایجاد محصول';

    public Product $product;
    public ProductVariant $productVariant;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    function createProductFromFormData(array $data): Product
    {
        return DB::transaction(function () use ($data) {
            // 1. پوشه جدید در صورت نیاز
            if (!empty($data['create_folder']) && $data['create_folder']) {
                $folderAvatar = $data['folder_avatar'][0] ?? null;
                $folderAvatarPath =
                    $folderAvatar instanceof UploadedFile
                        ? $folderAvatar->store('products/folders', 'public')
                        : null;

                $folder = ProductFolder::create([
                    'serial' => Str::random(8),
                    'avatar' => $folderAvatarPath,
                ]);

                $data['folder_id'] = $folder->id;
            }

            // 2. ایجاد محصول
            $product = Product::create([
                'name' => $data['name'],
                'serial' => $data['product_serial'],
                'user_id' => Auth::id(),
                'manager_id' => $data['manager_id'] ?? null,
                'procedure_id' => $data['procedure_id'],
                'product_group_id' => $data['product_group_id'],
                'folder_id' => $data['folder_id'] ?? null,
                'type' => $data['type'],
                'state' => 'DRAFT',
                'description' => $data['description'] ?? null,
            ]);

            // 3. ذخیره آواتار
            if (!empty($data['avatar']) && is_array($data['avatar'])) {
                $avatarFile = reset($data['avatar']);
                if ($avatarFile instanceof UploadedFile) {
                    $path = $avatarFile->store(
                        'products/avatars' . $data['product_serial'],
                        options: 'local',
                    );

                    $product->pictures()->create([
                        'path' => $path,
                        'avatar' => true,
                    ]);
                }
            }

            // 4. ذخیره تصاویر معمولی
            if (!empty($data['pictures']) && is_array($data['pictures'])) {
                foreach ($data['pictures'] as $picture) {
                    if ($picture instanceof UploadedFile) {
                        $path = $picture->store('products/pictures', 'public');

                        $product->pictures()->create([
                            'path' => $path,
                            'avatar' => false,
                        ]);
                    }
                }
            }

            // 5. ذخیره واریانت‌ها
            if (!empty($data['product_variants'])) {
                foreach ($data['product_variants'] as $variant) {
                    $width = (float) $variant['width'];
                    $height = (float) $variant['height'];

                    $product->variants()->create([
                        'serial' => $variant['variant_serial'],
                        'width' => $width,
                        'height' => $height,
                        'area' => $width * $height,
                        'perimeter' => 2 * ($width + $height),
                    ]);
                }
            }

            // 6. ذخیره زیردسته‌ها
            foreach ($data as $key => $value) {
                if (
                    Str::startsWith($key, 'sub_category_') &&
                    is_array($value)
                ) {
                    $product->categories()->attach($value);
                }
            }

            return $product;
        });
    }

    public function create()
    {
        $this->validate();

        $this->product = $this->createProductFromFormData($this->data);

        $this->data = [...$this->data, 'id' => $this->product->id];

        // نمایش پیام موفقیت
        Notification::make()
            ->title('محصول با موفقیت ایجاد شد')
            ->success()
            ->body(
                'در صورت نیاز می‌توانید قبل از تأیید نهایی، اطلاعات را ویرایش کنید.',
            )
            ->persistent()
            ->send();
    }

    public function confirm(?bool $return = false)
    {
        $this->product->state = ProductState::Active->value;
        $this->product->save();

        if ($return) {
            return to_route(
                'filament.management.resources.product-management.products.create',
            );
        }

        return to_route(
            'filament.management.resources.product-management.products.index',
        );
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Wizard::make([
                    Wizard\Step::make('product')
                        ->label('محصول')
                        ->icon('lucide-boxes')
                        ->schema($this->productForm())
                        ->columns(6),
                    Wizard\Step::make('variants')
                        ->label('سایز ها')
                        ->icon('lucide-boxes')
                        ->schema($this->variantsForm()),
                    Wizard\Step::make('folder')
                        ->label('پوشه بندی')
                        ->icon('lucide-folder-closed')
                        ->schema($this->folderForm()),
                    Wizard\Step::make('categories')
                        ->label('دسته بندی')
                        ->icon('')
                        ->schema($this->categoriesForm()),
                ])->submitAction(
                    new HtmlString(
                        Blade::render(
                            <<<BLADE
                                <x-filament::button
                                    type="submit"
                                    size="sm"
                                >
                                    ارسال
                                </x-filament::button>
                            BLADE
                            ,
                        ),
                    ),
                ),
            ])
            ->statePath('data');
    }

    protected function productForm()
    {
        return [
            TextInput::make('product_serial')
                ->label('سریال')
                ->hintIcon(
                    'lucide-message-circle-question',
                    tooltip: 'این سریال مخصوص این محصول است و اگر محصول سایز های مختلف دارد، آن ها سریال مختص خود دارند.',
                )
                ->prefixAction(function (Set $set) {
                    $set(
                        'product_serial',
                        SerialHelper::generate(
                            model: new Product(),
                            min: 1000,
                            max: 999999,
                        ),
                    );
                })
                ->suffixAction(
                    Action::make('generateSerial')
                        ->icon('lucide-refresh-ccw')
                        ->label('سریال جدید')
                        ->action(function (Set $set) {
                            $set(
                                'product_serial',
                                SerialHelper::generate(
                                    new Product(),
                                    min: 1000,
                                    max: 999999,
                                ),
                            );
                        }),
                )
                ->required()
                ->unique(Product::class, 'serial')
                ->live(onBlur: true)
                ->columnSpan(3),
            TextInput::make('name')->label('نام کالا')->columnSpan(3),
            Select::make(name: 'procedure_id')
                ->label('روند تولید')
                ->options(Procedure::all()->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->columnSpan(2),
            Select::make(name: 'product_group_id')
                ->label('گروه کالا')
                ->options(ProductGroup::all()->pluck('name', 'id'))
                ->searchable()
                ->required()
                ->columnSpan(2),
            ToggleButtons::make('type')
                ->label('نوع')
                ->options(ProductType::class)
                ->inline()
                ->required()
                ->columnSpan(2),
            Textarea::make('description')->label('توضیحات')->columnSpanFull(),
            FileUpload::make('avatar')
                ->label('تصویر اصلی محصول')
                ->image()
                ->imageEditor()
                ->columnSpanFull()
                ->required(),
            FileUpload::make('pictures')
                ->label('تصویرهای بیشتر')
                ->image()
                ->imageEditor()
                ->multiple()
                ->columnSpanFull(),
        ];
    }

    protected function folderForm()
    {
        return [
            ToggleButtons::make('create_folder')
                ->label('ایجاد پوشه')
                ->helperText(
                    'اگر محصول مورد نظر مدل های مختلفی دارد لطفا آن ها را در یک پوشه قرار دهید.',
                )
                ->options([
                    true => 'بله',
                    false => 'خیر',
                ])
                ->live()
                ->inline()
                ->boolean()
                ->required(),
            Fieldset::make('folder_details')
                ->label('اطلاعات پوشه')
                ->schema([
                    ToggleButtons::make('new_folder')
                        ->label('پوشه جدید')
                        ->helperText(
                            'مشخص کنید که آیا می خواهید پوشه جدید ایجاد کنید یا از پوشه های موجود استفاده کنید.',
                        )
                        ->options([
                            true => 'بله',
                            false => 'خیر',
                        ])
                        ->default(true)
                        ->live()
                        ->inline()
                        ->boolean()
                        ->required(),
                    Select::make('folder')
                        ->label('پوشه ها')
                        ->options(ProductFolder::all()->pluck('name', 'id'))
                        ->required(fn(Get $get) => !$get('new_folder'))
                        ->visible(fn(Get $get) => !$get('new_folder'))
                        ->live()
                        ->searchable()
                        ->columnSpanFull(),
                    FileUpload::make('folder_avatar')
                        ->label('تصویر پوشه')
                        ->image()
                        ->imageEditor()
                        ->live()
                        ->visible(fn(Get $get) => $get('new_folder'))
                        ->columnSpanFull(),
                ])
                ->visible(fn(Get $get) => $get('create_folder')),
        ];
    }

    protected function variantsForm()
    {
        return [
            Repeater::make('product_variants')
                ->hiddenLabel()
                ->schema([
                    TextInput::make('variant_serial')
                        ->label('سریال')
                        ->hintIcon(
                            'lucide-message-circle-question',
                            tooltip: 'این سریال مختص این سایز از محصول است. اگر این سایز از قبل سریال دارد لطفا آن سریال را اینجا وارد کنید.',
                        )
                        ->afterStateHydrated(function (Set $set) {
                            $set(
                                'variant_serial',
                                SerialHelper::generate(
                                    model: new Product(),
                                    min: 1000,
                                    max: 999999,
                                ),
                            );
                        })
                        ->suffixAction(
                            Action::make('generateSerial')
                                ->icon('lucide-refresh-ccw')
                                ->label('سریال جدید')
                                ->action(function (Set $set) {
                                    $set(
                                        'variant_serial',
                                        SerialHelper::generate(
                                            new Product(),
                                            min: 1000,
                                            max: 999999,
                                        ),
                                    );
                                }),
                        )
                        ->required()
                        ->unique(ProductVariant::class, 'serial')
                        ->columnSpan(1),
                    TextInput::make('width')
                        ->label('عرض')
                        ->numeric()
                        ->minValue(0)
                        ->suffix('cm')
                        ->required()
                        ->columnSpan(1),
                    TextInput::make('height')
                        ->label('ارتفاع')
                        ->numeric()
                        ->minValue(0)
                        ->suffix('cm')
                        ->required()
                        ->columnSpan(1),
                ])
                ->addActionLabel('سایز بیشتر')
                ->columns(3),
        ];
    }

    protected function categoriesForm()
    {
        return [
            Grid::make(2) // نمایش دو ستونه
                ->schema(
                    ProductCategory::all()
                        ->map(function ($category) {
                            return Select::make("sub_category_{$category->id}")
                                ->label($category->name)
                                ->options(
                                    $category->subCategories->pluck(
                                        'name',
                                        'id',
                                    ),
                                )
                                ->searchable()
                                ->multiple()
                                ->nullable();
                        })
                        ->toArray(),
                ),
        ];
    }

    public function productInfolist(Schema $schema): Schema
    {
        return $schema->record($this->product)->components([
            Section::make([
                ImageEntry::make('avatar.path')->label('تصویر اصلی محصول'),
                ImageEntry::make('pictures.path')->label('تصویرهای بیشتر'),
            ]),
            Section::make([
                TextEntry::make('serial')->label('سریال'),
                TextEntry::make('name')->label('نام کالا'),
                TextEntry::make('procedure.name')->label('روند تولید'),
                TextEntry::make('group.name')->label('گروه کالا'),
                TextEntry::make('type')->label('نوع')->badge(),
                TextEntry::make('folder.name')->label('پوشه'),
                TextEntry::make('description')
                    ->label('توضیحات')
                    ->html()
                    ->columnSpanFull(),
                TextEntry::make('categories.name')
                    ->label('دسته بندی')
                    ->badge()
                    ->columnSpanFull(),
            ])
                ->heading('بازبینی محصول')
                ->columns(3),
            RepeatableEntry::make('variants')
                ->label('سایز ها')
                ->schema([
                    TextEntry::make('serial')->label('سریال'),
                    TextEntry::make('width')->label('عرض'),
                    TextEntry::make('height')->label('ارتفاع'),
                ])
                ->columns(3),
        ]);
    }
}
