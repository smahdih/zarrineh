@pure

@props([
    'placeholder' => null,
    'suffix' => null,
    'max' => null,
])

@php
    $classes = Flux::classes()
        ->add('truncate flex gap-2 text-start flex-1 text-zinc-700')
        ->add('[[disabled]_&]:text-zinc-500 dark:text-zinc-300 dark:[[disabled]_&]:text-zinc-400');
@endphp

<ui-selected x-ignore wire:ignore {{ $attributes->class($classes) }}>
    <template name="placeholder">
        <span class="ms-1 text-zinc-400 [[disabled]_&]:text-zinc-400/70 dark:text-zinc-400 dark:[[disabled]_&]:text-zinc-500" data-flux-pillbox-placeholder>
            {{ $placeholder }}
        </span>
    </template>

    <template name="option">
        <div class="px-2 py-1 rounded-md flex text-zinc-700 dark:text-zinc-200 bg-zinc-400/15 dark:bg-zinc-400/40">
            <div class="text-sm font-medium leading-[1rem]"><slot name="text"></slot></div>

            <ui-selected-remove class="px-1 py-1 -me-2 -my-1 text-zinc-400 hover:text-zinc-800 dark:text-zinc-400 dark:hover:text-zinc-200">
                <flux:icon.x-mark variant="micro" />
            </ui-selected-remove>
        </div>
    </template>

    <template name="options">
        <div class="flex flex-wrap gap-1">
            <slot></slot>
        </div>
    </template>
</ui-selected>