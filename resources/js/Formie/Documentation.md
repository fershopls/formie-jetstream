# How to use it?


### ProductController.php
```php
class ProductController extends Controller
{
    public function create()
    {
        return inertia('Backend/Products/CreateEdit');
    }
    
    public function edit($id)
    {
        $model = Product::findOrFail($id);
        return inertia('Backend/Products/CreateEdit', compact('model'));
    }
}
```


### CreateEdit.vue
```html
<template>
<formie
    :form="form"
    :model="model"
    :errors="$page.props.errors"
    :debug="true"
/>
</template>

<script>
import Formie from '@/Formie/Formie';
import form from './form.js';

export default {
  props: ['model'],

  components: {
    Formie,
  },
  
  setup () {
    return { form };
  }
}
</script>
```


### form.js
```js
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

const onSave = ({ values }) => {
    if (values.id) {
        const url = route('products.update', values.id);
        Inertia.put(url, values);
    } else {
        const url = route('products.store');
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
    options: {
      admin: "Inmuebles",
      editor: "Videojuegos",
      mod: "Artistas"
    }
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
        clicked: onSave,
      }
    ]
  }
];

```
