<?php

use Livewire\Volt\Component;
use App\Models\Products\Product;
use App\Models\Products\Categories\ProductCategory;
use App\Models\Products\Groups\ProductGroup;

new class extends Component {
    public string $search = '';
    public array $selectedCategory = [];
    public array $selectedGroup = [];
    public string $active = 'home';

    public $products = [];
    public $categories = [];
    public $groups = [];

    public function mount()
    {
        $this->categories = ProductCategory::all();
        $this->groups = ProductGroup::all();
        $this->loadProducts();
    }

    public function searchUpdated()
    {
        $this->loadProducts();
    }

    public function updated($name)
    {
        if (in_array($name, ['search', 'selectedCategory', 'selectedGroup'])) {
            $this->loadProducts();
        }
    }

    public function loadProducts()
    {
        $query = Product::query()
            ->with(['avatar', 'productGroup', 'categories.category'])
            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%")->orWhere('serial', 'like', "%{$this->search}%"))
            ->when(!empty($this->selectedGroup), fn($q) => $q->whereIn('product_group_id', $this->selectedGroup))
            ->when(!empty($this->selectedCategory), fn($q) => $q->whereHas('categories', fn($c) => $c->whereIn('sub_category_id', $this->selectedCategory)))
            ->latest()
            ->get();

        $this->products = $query;
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->selectedCategory = [];
        $this->selectedGroup = [];

        $this->loadProducts();
    }
};
?>

<div class="flex flex-col gap-6">

    {{-- 🔍 فیلتر و جستجو --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-3 w-full md:w-1/3">
            <flux:input icon="magnifying-glass" wire:model.live.debounce.500ms="search" type="text"
                placeholder="جستوجو سریال یا نام ..." />
        </div>

        <div class="hidden md:flex gap-3 w-full md:w-auto">
            <flux:modal.trigger name="filter-products">
                <flux:button>جستجوپیشرفته</flux:button>
            </flux:modal.trigger>
            <flux:button variant="primary" color="green"
                href="{{ route('filament.productManagement.resources.products.create') }}">
                + محصول جدید
            </flux:button>
        </div>
    </div>

    {{-- 🧩 شبکه محصولات --}}
    @if (count($products))
        <div class="grid grid-cols-1 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-6">
            @foreach ($products as $product)
                <flux:card class="overflow-hidden flex flex-col justify-between group hover:shadow-md transition"
                    wire:key="{{ $product->serial }}">
                    {{-- تصویر --}}
                    <div class="relative h-44 bg-gray-100 dark:bg-gray-800 overflow-hidden rounded-md">
                        @if ($product->avatar)
                            <img src="{{ $product->avatar->path_url }}" class="object-cover w-full h-full" />
                        @else
                            <div class="flex items-center justify-center h-full text-gray-400">
                                <x-flux::icon name="photo" class="w-8 h-8" />
                            </div>
                        @endif
                        @if ($product->state)
                            <flux:badge variant="solid" size="sm" :color="$product->state->getColor()"
                                class="absolute top-2 left-2">
                                {{ $product->state->getLabel() }}
                            </flux:badge>
                        @endif
                    </div>

                    {{-- اطلاعات --}}
                    <div class="pt-5 flex flex-col gap-2">
                        <flux:heading size="md">{{ $product->name }}</flux:heading>

                        <flux:text size="sm" class="text-gray-500">سریال: {{ $product->serial }}</flux:text>

                        @if ($product->productGroup)
                            <flux:text size="sm" class="text-gray-500">
                                گروه: {{ $product->productGroup->name }}
                            </flux:text>
                        @endif

                        @if ($product->categories->count())
                            <flux:text size="sm" class="text-gray-500">
                                دسته‌ها: {{ $product->categories->pluck('name')->join(', ') }}
                            </flux:text>
                        @endif

                        <div class="mt-3 flex justify-between items-center">
                            <div class="flex flex-row gap-2">
                                <flux:tooltip content="ویرایش">
                                    <flux:button icon="pencil-square" size="sm"
                                        href="{{ route('filament.productManagement.resources.products.edit', ['record' => $product->id]) }}">
                                    </flux:button>
                                </flux:tooltip>
                                <flux:tooltip content="نمایش">
                                    <flux:button icon="viewfinder-circle" icon-variant="outline" variant="ghost"
                                        size="sm" color="gray" wire:navigate.hover
                                        href="{{ route('products.show', ['product' => $product]) }}">
                                    </flux:button>
                                </flux:tooltip>
                            </div>
                            <div class="flex flex-row gap-2">
                                <flux:tooltip content="پرینت">
                                    <flux:button icon="printer" icon-variant="outline" variant="ghost" size="sm"
                                        color="gray"
                                        href="{{ route('filament.productManagement.resources.products.view', ['record' => $product->id]) }}">
                                    </flux:button>
                                </flux:tooltip>
                            </div>
                        </div>
                    </div>
                </flux:card>
            @endforeach
        </div>
    @else
        <div class="flex flex-col items-center justify-center py-16 text-gray-500">
            <x-flux::icon name="inbox" class="w-10 h-10 mb-3" />
            <p>هیچ محصولی یافت نشد.</p>
        </div>
    @endif

    <flux:modal name="filter-products" variant="flyout" position="bottom">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">فیلتر کردن محصولات</flux:heading>
            </div>

            <div class="grid sm:grid-cols-1 md:grid-cols-4 `    gap-3">
                <flux:field>
                    <flux:label>بر اساس دسته بندی</flux:label>
                    <flux:select variant="listbox" wire:model="selectedCategory"
                        placeholder="یک یا چند دسته بندی انتخاب کنید" multiple searchable>
                        @foreach ($categories as $cat)
                            <flux:label class="py-3 ps-1 text-gray-400">{{ $cat->name }}</flux:label>
                            @foreach ($cat->subCategories as $subCat)
                                <flux:select.option value="{{ $subCat->id }}" wire:key="{{ $subCat->id }}">
                                    {{ $subCat->name }}
                                </flux:select.option>
                            @endforeach
                        @endforeach
                    </flux:select>
                </flux:field>
                <flux:field>
                    <flux:label>براساس گروه کالا</flux:label>
                    <flux:select variant="listbox" wire:model="selectedGroup"
                        placeholder="یک یا چند گروه کالا انتخاب کنید" multiple searchable>
                        <flux:select.option value="">همه گروه‌ها</flux:select.option>
                        @foreach ($groups as $group)
                            <flux:select.option value="{{ $group->id }}" wire:key="{{ $group->id }}">
                                {{ $group->name }}
                            </flux:select.option>
                        @endforeach
                    </flux:select>
                </flux:field>

            </div>

            <div class="flex gap-3">
                <flux:spacer />
                <flux:button wire:click.prevent="clearFilters" variant="primary" color="amber">پاک کردن</flux:button>
                <flux:button wire:click.prevent="loadProducts" variant="primary">اعمال</flux:button>
            </div>
        </div>
    </flux:modal>
    <div
        class="fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-900 border-t border-gray-200 dark:border-gray-800 shadow-md flex justify-around items-center py-2 px-4 md:hidden">
        <a href="{{ route('filament.productManagement.resources.products.create') }}"
            class="flex flex-col items-center text-xs">
            <x-flux::icon name="plus-circle" class="w-6 h-6" />
            محصول جدید
        </a>

        <flux:modal.trigger name="filter-products">
            <button class="flex flex-col items-center text-xs">
                <x-flux::icon name="magnifying-glass" class="w-6 h-6" />
                جستوجو پیشرفته
            </button>
        </flux:modal.trigger>
    </div>
</div>
