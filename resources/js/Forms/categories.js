import { Inertia } from '@inertiajs/inertia';
import Buttons from '@/Formie/Inputs/Button';


function onDelete({ id }) {
    if (id) {
        const url = route('categories.destroy');
        Inertia.delete(url);
    }
}

function onSave({ values }) {
    const url = route('categories.store');
    Inertia.post(url, values);
}


export default () => [
    {
        name: 'name',
        label: 'Nombre',
        type: 'text',
    },
    {
        type: Buttons,
        buttons: [
            function ({ id }) {
                return id ? {
                    label: "Eliminar",
                    class: 'bg-red-700 text-white',
                    clicked: onDelete,
                } : null;
            },
            {
                label: 'Guardar',
                clicked: onSave,
            }
        ]
    }
]
