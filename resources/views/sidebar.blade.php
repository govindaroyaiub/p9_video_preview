<div class="sidebar md:w-1/6 mx-4 bg-gray-200 rounded-lg md:flex flex-col justify-between">
    <ul class="space-y-2">
        <li class="{{ request()->is('/') ? 'bg-primary text-white rounded-lg' : '' }}"><a
                class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="/">Dashboard</a>
        </li>
        <li class="{{ request()->is('project') || request()->is('project/*') ? 'bg-primary text-white rounded-lg' : '' }}"><a
                class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="/project">Projects</a>
        </li>
        <li class="{{ request()->is('logo') || request()->is('logo/*') ? 'bg-primary text-white rounded-lg' : '' }}"><a
                class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="/logo">Logos</a>
        </li>
        <li class="{{ request()->is('sizes') || request()->is('sizes/*') ? 'bg-primary text-white rounded-lg' : '' }}"><a
                class="rounded-lg hover:bg-primary hover:text-white px-3 py-2 block" href="/sizes">Sizes</a>
        </li>
    </ul>

    <div class="text-center text-sm text-gray-700 mb-2">&copy; Planetnine - <?= Date('Y') ?></div>
</div>
