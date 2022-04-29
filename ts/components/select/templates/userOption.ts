import template from './baseTemplate'

export default template(`
<div class="flex items-center gap-x-3">
    <img :src="option.src" class="shrink-0 h-6 w-6 rounded-full">

    <span x-text="option.label"></span>
</div>
`)
