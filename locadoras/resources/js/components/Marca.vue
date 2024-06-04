<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Buscar Marca</div>
                    
                        <div class="card-body">
                            <div class=" form row">
                                <div class="col mb-3">
                                <label for="buscarMarca" class="form-label">Id</label>
                                <input type="number" class="form-control" id="idMarca" aria-describedby="idHelpe">
                                <div id="idHelpe" class="form-text text muted">Opicional. Informe o id </div>
                            </div>
                            <div class="mb-3 col">
                                <label for="nomeMarca" class="form-label">Nome da Marca</label>
                                <input type="text" class="form-control" id="nomeMarca">
                            </div>
                        </div>
                    </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm float-right">Pesquisar</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
