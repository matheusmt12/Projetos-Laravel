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
                    <td>
                        <button v-if="visualizacao" type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modalMarcaVisualizar" @click="setStore(obj)">Visualizar</button>
                    </td>                    <td>
                        <button type="button" class="btn btn-secondary btn-sm">Editar</button>
                    </td>                    <td>
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalMarcaDeletar"  @click="setStore(obj)">Apagar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props :['dados' , 'titulos','visualizacao','editar','apagar'],
        methods :{
            setStore(obj){
                this.$store.state.item = obj;
                
            }
        }
    }
</script>
