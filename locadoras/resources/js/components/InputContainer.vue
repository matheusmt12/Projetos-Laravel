<template>
    <div>
        <label :for="id" class="form-label">{{ titulo }}</label>
        <slot></slot>
        <div :id="idHelpe" class="form-text text muted">{{ tituloAjuda }}</div>

    </div>
</template>

<script>
    export default {
        props : ['id', 'titulo', 'idHelpe' ,'tituloAjuda']
    }
</script>
