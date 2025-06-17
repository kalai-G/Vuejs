<template>
  <h4>hi {{ test }}</h4>
  <ul>
    <li>
      {{ count }}
    </li>
    <li>
      {{ active }}
    </li>
    <li>
      {{ user }}
    </li>
  </ul>
</template>
<script>
export default {
  name: "PropsTesting",
  //   props: ["test"],
  props: {
    test: {
      type: Number,
      required: true,
    },
    count: {
      type: Number,
      required: true,
    },
    active: {
      type: Boolean,
      required: true,
    },
    user: {
      type: String,
      required: true,
      //   default: "Hello",
      default: "Hello",
    },
  },
};
</script>
