<x-filament-panels::page>
    @if ($product)
        {{ $this->productInfolist }}

        <div class="mt-6 flex justify-end gap-3">
            <x-filament::button color="warning"
                href="{{ route('filament.productManagement.resources.products.edit', $product) }}" tag="a">
                ویرایش محصول
            </x-filament::button>
            <x-filament::button color="success" wire:click="confirm">تأیید نهایی و ایجاد یکی دیگر</x-filament::button>
            <x-filament::button color="success" wire:click="confirm">تأیید نهایی</x-filament::button>
        </div>
    @else
        <form wire:submit="create">
            {{ $this->form }}
        </form>
    @endif

    <x-filament-actions::modals />
</x-filament-panels::page>
