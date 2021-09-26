import { showConfirmDialog } from '../dialog';
const getElements = (component) => {
    return [...component.querySelectorAll('[x-on\\:confirm]')]
        .filter(element => !element.getAttribute('x-on:click'));
};
const initialize = (component) => {
    const elements = getElements(component);
    elements.forEach(element => {
        const insideAlpineComponent = element.closest('[x-data]');
        const confirmData = element.getAttribute('x-on:confirm');
        const componentId = element.closest('[wire\\:id]')?.getAttribute('wire:id');
        if (!componentId) {
            throw new Error('Livewire Component id not found in x-on:confirm directive');
        }
        if (insideAlpineComponent) {
            return element.setAttribute('x-on:click', `$wireui.confirmAction(${confirmData}, '${componentId}')`);
        }
        element.onclick = () => {
            const options = eval(`(${confirmData})`);
            showConfirmDialog(options, componentId);
        };
    });
};
document.addEventListener('livewire:load', () => initialize(document.body));
document.addEventListener('DOMContentLoaded', () => {
    window.Livewire.hook('message.processed', (_message, component) => {
        initialize(component.el);
    });
});
//# sourceMappingURL=confirm.js.map