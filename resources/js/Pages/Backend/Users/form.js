import InputRadio from "@/Formie/Inputs/Radio";
import FieldButton from "@/Formie/Inputs/Button";

export default [
  {
    name: "name",
    label: "Nombre Completo",
    type: "text"
  },
  {
    name: "email",
    label: "Correo Electrónico",
    type: "email"
  },
  {
    name: "password",
    label: "Contraseña",
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
      {
        label: "Eliminar",
        class: "bg-red-700 text-white",
        clicked(context) {
          console.log("Delete id", context.values.id, context);
        }
      },
      {
        label: "Guardar",
        type: "submit"
      }
    ]
  }
];
