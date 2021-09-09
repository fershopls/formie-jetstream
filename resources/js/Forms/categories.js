import { Inertia } from '@inertiajs/inertia';
import Buttons from '@/Formie/Inputs/Button';


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
            {
                label: 'Guardar',
                clicked: onSave,
            }
        ]
    }
]
