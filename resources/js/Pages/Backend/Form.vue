<template>
  <app-layout title="Form">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ title }}
      </h2>
    </template>

    <div>
      <div class="max-w-xl mx-auto py-10 sm:px-6 lg:px-8">

        <div class="px-4 py-4 bg-white rounded shadow-sm">
          <formie
            :form="form"
            :model="model"
            :errors="$page.props.errors"
          />
        </div>

        <!-- <jet-section-border /> -->

      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetSectionBorder from "@/Jetstream/SectionBorder.vue";

import Formie from "@/Formie/Formie";

export default {
  props: ["model", "title", "categories", "form"],

  components: {
    AppLayout,
    JetSectionBorder,

    Formie,
  },

  setup(props) {
    const form = require(`@/Forms/${props.form}`).default;

    return {
      form: form(props),
    };
  },

  methods: {},
};
</script>
