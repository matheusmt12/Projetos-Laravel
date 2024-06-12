<template>
    <div class="container">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col" v-for="t in titulos" :key="t" class="text-capitalize">{{ t }}</th>

                </tr>
            </thead>
            <tbody>
                <tr v-for="obj in dados" :key="obj.id">
                    <td v-if="titulos.includes(chave)" v-for="valor, chave in obj" :key="valor">
                         {{ valor }}
                    </td>
                <!-- <th scope="row">{{ m.id }}</th>
                    <td>{{ m.name}}</td>
                    <td>{{ m.imagem}}</td> -->
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props :['dados' , 'titulos']
    }
</script>
