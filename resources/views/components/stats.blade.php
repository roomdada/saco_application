@props(['label', 'value'])
<div
    class="flex flex-col rounded-xl border-2 border-red-900 shadow-lg bg-white overflow-hidden hover:shadow-sm hover:cursor-pointer">
    <div class="p-5 lg:p-6 flex-grow w-full">
        <dl class="text-left">
            <dt class="text-2xl font-bold text-red-900">
                {{ $value }}
            </dt>
            <dd class="uppercase font-semibold text-sm text-black tracking-wider">
                {{ $label }}
            </dd>
        </dl>
    </div>
</div>
