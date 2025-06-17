<template>
  <div class="container">
    <h3>List rendering</h3>
    <!-- like for each in script  -->
    <li v-for="item in items" :key="item.id">
      {{ item.message }}
    </li>
    <h3>Using Objects</h3>
    <div class="container d-flex">
      <!-- <button v-for="(value, key) in myObject" :key="key"  @click="list" :class="btnClass">
        {{ key }}: {{ value }}
      </button> -->
      <button
  v-for="(value, key) in myObject" :key="key" @click="toggleButton(value)" :class="['btn m-2', clickedKey === key ? 'btn-success' : 'btn-outline-primary']"
>
  {{ key }}: {{ value }}
</button>
    </div>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">
            <button v-if="seen" @click="count++">
              if part Count:{{ count }}
            </button>
            <button v-else @click="count++">Else part Count:{{ count }}</button>
          </th>
          <th scope="col">First</th>
          <th scope="col">email</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="employee in employees" :key="employee.id">
          <th scope="row">{{ employee.id }}</th>
          <td>{{ employee.name }}</td>
          <td>{{ employee.email }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
export default {
  name: "employee-table",
  props: {
    employees: Array,
  },
  data() {
    return {
      count: 0,
      seen: false,
      btnClass: "btn btn-outline-primary m-2", 
      //Using array
      items: [{ message: "Foo" }, { message: "Bar" }],
      // using objects
      myObject: {
        title: "How to do lists in Vue",
        author: "Jane Doe",
        publishedAt: "2016-04-10",
        publishedAt_1: "2016-04-10",
        publishedAt_2: "2016-04-10",
        publishedAt_3: "2016-04-10",
      },
      clickedKey: null, 
    };
  },
  methods: {
  toggleButton(key) {
    // this.clickedKey = this.clickedKey === key ? null : key;
    alert(key);  
  },
}
  // computed should be an object   
 
};
</script>

<style scoped>
button.btnClass {
  background-color: #000 !important;
  color: #fff !important;
}
.table {
  width: 100%;
  border-collapse: collapse;
  font-family: Arial, sans-serif;
}

.table th,
.table td {
  padding: 12px 15px;
  border: 1px solid #ddd;
  text-align: left;
}

.table thead {
  background-color: #007bff;
  color: white;
}

.table tbody tr:nth-child(even) {
  background-color: #f9f9f9;
}

.table tbody tr:hover {
  background-color: #f1f1f1;
  transition: background-color 0.3s ease;
}
.container  {
  margin: 120px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     
