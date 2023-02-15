

<template>

    <Head title="Clientes"></Head>
    <AuthenticatedLayout>
        <template #header>
            <div class="container-fluid mt-3 bg-white">

                <form class="row g-3">
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually-hidden">Email</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="email@example.com">
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Password</label>
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                    </div>
                    <div class="col-auto">
                        <label for="staticEmail2" class="visually-hidden">Email</label>
                        <input type="text" readonly class="form-control-plaintext" id="staticEmail2"
                            value="email@example.com">
                    </div>
                    <div class="col-auto">
                        <label for="inputPassword2" class="visually-hidden">Password</label>
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3">Confirm identity</button>
                    </div>
                </form>

            </div>

            <div class="row mt-3">
                <div class="col-md.10 offset-md-1">
                    <div class="table-responsive">
                        <table class="table table-stripeted table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>

                                    <th>Nombre</th>
                                    <th>Imagen</th>
                                    <th>Cedula</th>
                                    <th>Correo</th>
                                    <th>Teléfono</th>
                                    <th>Observaciones</th>
                                </tr>
                            </thead>
                            <tbody v-for="customer, i in customers " :key="customer.id">
                                <td>{{ i+ 1 }}</td>
                                <td>{{ customer.name }}</td>
                                <td>{{ customer.img }}</td>
                                <td>{{ customer.document }}</td>
                                <td>{{ customer.email }}</td>
                                <td>{{ customer.telephone }}</td>
                                <td>{{ customer.observations }}</td>
                                <td>
                                    <button v-on:click="getcustomersByDI(customer.id)"></button>
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </template>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Swal from 'sweetalert2';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';
import axios from 'axios'
import * as Vue from 'vue' // in Vue 3

import VueAxios from 'vue-axios'




const from = reactive({
    name: null,
    document: null,
    email: null,
    telephone: null,
    observations: null,
    img: null
});






const getcustomersByDI = (id) => {
    // console.log(id);

    Vue.axios.get("http://127.0.0.1:8000/api/services/indexById/".id).then((response) => {
        console.log(response.data)
    })

}

const props = defineProps({
    customers: { type: Object }
});
</script>
