import { Inertia } from '@inertiajs/inertia';

import InputRadio from "@/Formie/Inputs/Radio";
import InputTextarea from "@/Formie/Inputs/Textarea";
import FieldButton from "@/Formie/Inputs/Button";
import FieldUpload from "@/Formie/Inputs/Upload";

import ImageApiManager from "./ImageApiManager";


const onDelete = ({model}) => {
    if (model.id && confirm("Estas seguro?")) {
        const url = route('products.destroy', model.id);
        Inertia.delete(url);
    }
};

const onSubmit = ({ model, values }) => {
    if (model.id) {
        const url = route('products.update', model.id);
        Inertia.post(url, {_method: 'PUT', ...values});
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
    name: "images_upload",
    label: "Imágenes",
    type: FieldUpload,
    multiple: true,
  },
  {
      type: ImageApiManager,
  },
  {
    name: "category_id",
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
      function ({ model }) {
          if (model.id) {
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
