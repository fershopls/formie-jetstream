import { Inertia } from '@inertiajs/inertia';

import InputRadio from "@/Formie/Inputs/Radio";
import Buttons from "@/Formie/Inputs/Buttons";


const onDelete = ({ id }) => {
    if (id && confirm("Estas seguro?")) {
        const url = route('users.destroy', id);
        Inertia.delete(url);
    }
};

const onSubmit = ({ id }) => {
    if (id) {
        const url = route('users.update', id);
        Inertia.put(url, values);
    } else {
        const url = route('users.store');
        Inertia.post(url, values);
    }
}


export default () => [
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
    type: Buttons,
    buttons: [
      // Button delete
      function ({ id }) {
          if (id) {
            return {
                label: "Eliminar",
                class: "bg-red-700 text-white",
                clicked: onDelete,
            };
        }
      },

      // Button save
      {
        label: "Guardar",
        type: "submit",
        clicked: onSubmit,
      }
    ]
  }
];
