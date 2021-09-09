import { Inertia } from '@inertiajs/inertia';
import Buttons from '@/Formie/Inputs/Buttons';
import InputCheckbox from '@/Formie/Inputs/Checkbox';


function onDelete({ id }) {
    if (id && confirm("Seguro?")) {
        const url = route('categories.destroy', id);
        Inertia.delete(url);
    }
}

function onSave({ id, values }) {
    if (id) {
        const url = route('categories.update', id);
        const data = { _method: 'PUT', ...values };
        Inertia.post(url, data);
    } else {
        const url = route('categories.store');
        Inertia.post(url, values);
    }
}


export default () => [
    {
        name: 'name',
        label: 'Nombre',
        type: 'text',
    },
    {
        name: 'active',
        label: 'Activada',
        default: true,
        type: InputCheckbox,
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
