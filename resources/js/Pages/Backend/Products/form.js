import { Inertia } from '@inertiajs/inertia';

import InputRadio from "@/Formie/Inputs/Radio";
import InputTextarea from "@/Formie/Inputs/Textarea";
import FieldButton from "@/Formie/Inputs/Button";
import FieldUpload from "@/Formie/Inputs/Upload";


const onDelete = ({values}) => {
    if (values.id && confirm("Estas seguro?")) {
        const url = route('products.destroy', values.id);
        Inertia.delete(url);
    }
};

const onSubmit = ({ values }) => {
    if (values.id) {
        const url = route('products.update', values.id);
        Inertia.put(url, values);
    } else {
        const url = route('products.store');
        Inertia.post(url, values);
    }
}


export default (props) => [
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
    type: InputTextarea
  },
  {
    name: "images",
    label: "Imágenes",
    type: FieldUpload,
    multiple: true,
  },
  {
    name: "category",
    label: "Categoría",
    type: InputRadio,
    attrs: {
      class: "flex-col"
    },
    options: props.categories,
  },
  {
    type: FieldButton,
    buttons: [
      // Delete async button
      function ({ values }) {
          if (values.id) {
            return {
              label: "Eliminar",
              class: "bg-red-700 text-white",
              clicked: onDelete,
            };
          }
      },

      // Save button
      {
        label: "Guardar",
        type: "submit",
        clicked: onSubmit,
      }
    ]
  }
];
