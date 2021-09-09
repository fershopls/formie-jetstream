import { Inertia } from '@inertiajs/inertia';

import InputRadio from "@/Formie/Inputs/Radio";
import FieldButton from "@/Formie/Inputs/Button";


const onDelete = ({values}) => {
    if (values.id && confirm("Estas seguro?")) {
        const url = route('users.destroy', values.id);
        Inertia.delete(url);
    }
};

const onSubmit = ({ values }) => {
    if (values.id) {
        const url = route('users.update', values.id);
        Inertia.put(url, values);
    } else {
        const url = route('users.store');
        Inertia.post(url, values);
    }
}


export default [
  {
    name: "name",
    label: "Nombre del Producto",
    type: "text"
  },
  {
    name: "price",
    label: "Precio",
    type: "number"
  },
  {
    name: "description",
    label: "Descripción",
    type: "textarea"
  },
  {
    name: "images",
    label: "Imágenes",
    type: "password"
  },
//   {
//     name: "role",
//     label: "Rol",
//     type: InputRadio,
//     attrs: {
//       class: "flex-col"
//     },
//     options: {
//       admin: "Administrador",
//       editor: "Creador de Contenido",
//       mod: "Moderador"
//     }
//   },
  {
    type: FieldButton,
    buttons: [
      ({ values }) => (!values.id?null:{
        label: "Eliminar",
        class: "bg-red-700 text-white",
        clicked: onDelete,
      }),
      {
        label: "Guardar",
        type: "submit",
        clicked: onSubmit,
      }
    ]
  }
];
