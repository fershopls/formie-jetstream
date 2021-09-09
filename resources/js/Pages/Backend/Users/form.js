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
    label: "Nombre Completo",
    type: "text"
  },
  {
    name: "email",
    label: "Correo Electrónico",
    type: "text"
  },
  {
    name: "password",
    label: "Contraseña",
    type: "password"
  },
  {
    name: "password_confirmation",
    label: "Repita su Contraseña",
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
