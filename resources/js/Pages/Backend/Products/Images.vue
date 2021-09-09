<template>
  <div class="grid grid-cols-2 gap-4 px-4">
    <div
      v-for="image in model.images"
      :key="image.id"
    >
      <img
        :src="image.url"
        alt=""
      >
    </div>
  </div>
</template>


<script>
export default {
  props: ["model"],

  components: {
    //
  },

  data() {
    return {
      //
    };
  },
};
</script>
