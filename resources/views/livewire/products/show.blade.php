<?php

use Livewire\Volt\Component;

new class extends Component {
    public \App\Models\Products\Product $product;

    public $selectedFolder = null;
    public $searchFolder = '';

    public function mount(\App\Models\Products\Product $product)
    {
        $this->product = $product;
    }

    #[\Livewire\Attributes\Computed]
    public function folders()
    {
        return \App\Models\Products\ProductFolder::query()->when($this->searchFolder, fn($q) => $q->where('serial', 'like', '%' . $this->searchFolder . '%'))->limit(20)->get();
    }

    public function setFolder()
    {
        $this->product->folder_id = $this->selectedFolder;
        $this->product->save();
        $this->selectedFolder = '';

        \Flux\Flux::toast('پوشه محصول تغییر کرد.');
    }

    public function unsetFolder()
    {
        $this->product->folder_id = null;
        $this->product->save();

        \Flux\Flux::toast('محصول از پوشه خارج شد.');
    }
}; ?>

<div>
    <div class="mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="w-full flex flex-row items-center justify-between pb-10">
            <flux:text size="lg">{{ $product->name ?? '' }}</flux:text>
            <flux:tooltip content="برگشت">
                <flux:button href="{{ route('products.index') }}" wire:navigate.hover icon="arrow-left" />
            </flux:tooltip>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- محتوای اصلی --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- تصاویر محصول --}}
                <flux:card>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            تصاویر محصول
                        </h2>

                        @if ($product->avatar)
                            <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden mb-4">
                                <img src="{{ $product->avatar->path_url }}" alt="{{ $product->name }}"
                                    class="w-full h-full object-cover">
                            </div>
                        @else
                            <div class="aspect-video bg-gray-100 rounded-lg flex items-center justify-center mb-4">
                                <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                        @endif

                        @if ($product->pictures->count() > 0)
                            <div class="grid grid-cols-4 gap-3">
                                @foreach ($product->pictures as $picture)
                                    <div
                                        class="aspect-square bg-gray-100 rounded-lg overflow-hidden hover:ring-2 hover:ring-blue-500 transition-all cursor-pointer">
                                        <img src="{{ $picture->path_url }}" alt="تصویر محصول"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </flux:card>

                {{-- اطلاعات محصول --}}
                <flux:card>

                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            اطلاعات محصول
                        </h2>

                        <div class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">نام
                                        محصول</label>
                                    <p class="text-gray-900 mt-1 font-medium">{{ $product->name }}</p>
                                </div>
                                <div>
                                    <label class="text-xs font-medium text-gray-500 uppercase tracking-wider">شماره
                                        سریال</label>
                                    <p class="text-gray-900 mt-1 font-mono text-md">{{ $product->serial }}</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label
                                        class="text-xs font-medium text-gray-500 uppercase tracking-wider">نوع</label>
                                    <div class="mt-1">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                            {{ $product->type->getLabel() }}
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <label
                                        class="text-xs font-medium text-gray-500 uppercase tracking-wider">وضعیت</label>
                                    <div class="mt-1">
                                        <span
                                            class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                            @if ($product->state->value === 'active') bg-green-100 text-green-800 border border-green-200
                                            @elseif($product->state->value === 'inactive') bg-gray-100 text-gray-800 border border-gray-200
                                            @else bg-yellow-100 text-yellow-800 border border-yellow-200 @endif">
                                            {{ $product->state->getLabel() }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            @if ($product->description)
                                <div>
                                    <label
                                        class="text-xs font-medium text-gray-500 uppercase tracking-wider">توضیحات</label>
                                    <p class="text-gray-700 mt-2 leading-relaxed">{{ $product->description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </flux:card>

                {{-- انواع محصول --}}
                @if ($product->variants->count() > 0)
                    <flux:card>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                </svg>
                                انواع محصول
                                <span
                                    class="ml-auto text-xs font-normal text-gray-500">{{ $product->variants->count() }}
                                    نوع</span>
                            </h2>

                            <div class="space-y-3">
                                @foreach ($product->variants as $variant)
                                    <div
                                        class="bg-gray-50 border border-gray-200 rounded-lg p-4 hover:border-gray-300 transition-colors">
                                        <div class="flex items-start justify-between">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                                                    </svg>
                                                    <p class="text-gray-900 font-medium font-mono">
                                                        {{ $variant->serial }}
                                                    </p>
                                                </div>

                                                <div class="grid grid-cols-2 md:grid-cols-4 gap-3 text-sm">
                                                    @if ($variant->width)
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-gray-500">عرض:</span>
                                                            <span
                                                                class="text-gray-900 font-medium">{{ number_format($variant->width) }}cm</span>
                                                        </div>
                                                    @endif

                                                    @if ($variant->height)
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-gray-500">ارتفاع:</span>
                                                            <span
                                                                class="text-gray-900 font-medium">{{ number_format($variant->height) }}cm</span>
                                                        </div>
                                                    @endif

                                                    @if ($variant->perimeter)
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-gray-500">محیط:</span>
                                                            <span
                                                                class="text-gray-900 font-medium">{{ number_format($variant->perimeter) }}cm</span>
                                                        </div>
                                                    @endif

                                                    @if ($variant->area)
                                                        <div class="flex items-center gap-1">
                                                            <span class="text-gray-500">مساحت:</span>
                                                            <span
                                                                class="text-green-600 font-semibold">{{ $variant->area / 10000 }}m²</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            @if ($variant->meta)
                                                <div class="flex flex-col items-end gap-2">
                                                    <button
                                                        class="text-blue-600 hover:text-blue-800 text-xs flex items-center gap-1"
                                                        onclick="alert(JSON.stringify({{ json_encode($variant->meta) }}, null, 2))">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                        </svg>
                                                        جزئیات
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </flux:card>
                @endif

                {{-- دسته‌بندی‌ها --}}
                @if ($product->categories->count() > 0)
                    <flux:card>
                        <div>
                            <h2 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                دسته‌بندی‌ها
                            </h2>

                            <div class="flex flex-wrap gap-2">
                                @foreach ($product->categories as $category)
                                    <flux:badge>{{ $category->category->name }}</flux:badge>
                                @endforeach
                            </div>
                        </div>
                    </flux:card>
                @endif
            </div>

            {{-- نوار کناری --}}
            <div class="space-y-6">
                {{-- آمار سریع --}}
                <flux:card>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">آمار سریع</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">گروه محصول:</span>
                                <span
                                    class="text-gray-900 text-sm font-medium">{{ $product->productGroup->name }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">فرآیند تولید:</span>
                                <span class="text-gray-900 text-sm font-medium">{{ $product->procedure->name }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">تاریخ ایجاد:</span>
                                <span
                                    class="text-gray-900 text-sm font-medium">{{ $product->created_at->format('Y/m/d') }}</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600 text-sm">آخرین بروزرسانی:</span>
                                <span
                                    class="text-gray-900 text-sm font-medium">{{ $product->updated_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </div>
                </flux:card>

                {{-- اطلاعات کاربر --}}
                @if ($product->user)
                    <flux:card>
                        <div>
                            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">ایجاد کننده
                            </h3>
                            <div class="space-y-4">
                                <div>
                                    <div class="flex items-center gap-3 mt-2">
                                        <flux:avatar :src="$product->user->profile_photo_url" />
                                        <div>
                                            <p class="text-gray-900 font-medium text-sm">{{ $product->user->name }}
                                            </p>
                                            <p class="text-gray-500 text-xs">{{ $product->user->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </flux:card>
                @endif

                {{-- پوشه --}}
                <flux:card>
                    <div class="flex flex-row w-full justify-between items-center">
                        <div>
                            <flux:text><span>پوشه: </span>
                                <span>{{ $product->folder->serial ?? 'اختصاص داده نشده' }}</span>
                            </flux:text>
                        </div>

                        <div class="flex flex-row gap-5">
                            @if (!$product->folder)
                                <flux:modal.trigger name="create-folder">
                                    <flux:tooltip content="ایجاد پوشه">
                                        <flux:button icon="folder-plus" icon-variant="outline" />
                                    </flux:tooltip>
                                </flux:modal.trigger>
                            @else
                                <flux:modal.trigger name="create-folder">
                                    <flux:tooltip content="تعویض پوشه">
                                        <flux:button icon="folder-arrow-down" icon-variant="outline" />
                                    </flux:tooltip>
                                </flux:modal.trigger>

                                <flux:tooltip content="حذف از پوشه">
                                    <flux:button wire:click.prevent="unsetFolder" icon="folder-minus"
                                        icon-variant="outline" />
                                </flux:tooltip>
                                <flux:tooltip content="باز کردن پوشه">
                                    <flux:button icon="folder-open" icon-variant="outline" />
                                </flux:tooltip>
                            @endif
                        </div>
                    </div>
                </flux:card>

                <flux:card>
                    <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wider mb-4">تاریخچه اتفاقات
                    </h3>
                    <div class="flex flex-col gap-2">
                        @foreach ($product->timeline as $event)
                            <div class="border rounded-xl px-5 py-2">
                                <flux:badge size="sm">{{ $event->type_label }}</flux:badge>
                                <flux:text class="ps-5">{{ $event->description }}</flux:text>
                            </div>
                        @endforeach
                    </div>
                </flux:card>
            </div>
        </div>
    </div>

    <flux:modal name="create-folder" class="w-96">
        <div class="space-y-6">
            <flux:select wire:model="selectedFolder" variant="combobox" label="انتخاب پوشه"
                placeholder="یک پوشه انتخاب کنید ..." empty="">
                <x-slot name="input">
                    <flux:select.input wire:model.live="searchFolder" />
                </x-slot>

                @forelse ($this->folders as $folder)
                    <flux:select.option value="{{ $folder->id }}" wire:key="{{ $folder->serial }}">
                        {{ $folder->serial }}</flux:select.option>
                @empty
                    <flux:text class="text-center p-4">پوشه ای پیدا نشد</flux:text>
                @endforelse
            </flux:select>

            <flux:button wire:click.prevent="setFolder" variant="primary" color="lime">تایید</flux:button>
        </div>
    </flux:modal>
</div>
