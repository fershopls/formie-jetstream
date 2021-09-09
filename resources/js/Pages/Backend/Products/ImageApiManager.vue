<template>
  <div
    v-if="context.model && context.model.id"
    class="bg-gray-100 rounded-lg px-2 py-4"
  >
    <div class="text-xs uppercase text-center tracking-widest font-bold text-gray-400">
      {{ context.model.images.length ? 'Imágenes' : 'Ninguna imágen' }}
    </div>
    <div
      v-if="context.model.images.length"
      class="mt-3 flex gap-4 justify-around flex-wrap"
    >
      <div
        v-for="image in context.model.images"
        :key="image.id"
        class="p-2 bg-white shadow-sm rounded"
      >
        <a
          :href="image.url"
          target="_blank"
        >
          <div class="rounded-md bg-gray-800 overflow-hidden h-24 w-24 flex items-center justify-center">
            <img
              :src="image.url"
              alt=""
            >
          </div>
        </a>
        <div
          class="mt-2 tracking-wide text-center underline text-red-600 cursor-pointer"
          @click="onDelete(context.model.id, image.id)"
        >
          Eliminar
        </div>
      </div>
    </div>
  </div>
</template>


<script>
export default {
  props: ["field", "context"],

  methods: {
    onDelete(product_id, image_id) {
      if (!confirm("Estas seguro?")) return;

      const url = route("products.images.destroy", image_id);
      this.$inertia.delete(url, { preserveScroll: true });
    },
  },

  data() {
    return {
      //
    };
  },
};
</script>
