<script setup>
import { onMounted, ref } from 'vue';
import { defineModel, defineExpose } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);
const showPassword = ref(false);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

const togglePasswordVisibility = () => {
    showPassword.value = !showPassword.value;
};

defineExpose({
    focus: () => input.value.focus(),
    showPassword,
});

</script>


<template>
    <div class="relative border-0 w-full">
        <input
            :type="showPassword ? 'text' : 'password'"
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm py-2.5 pr-10 w-full"
            v-model="model"
            ref="input"
            placeholder="Enter your password"
            style="padding-right: 2.5rem;"
        />
        <span @click="togglePasswordVisibility" class="absolute inset-y-0 right-5 flex items-center cursor-pointer text-gray-500 pr-3">
            <i :class="showPassword ? 'fa fa-eye' : 'fa fa-eye-slash'"></i>
        </span>
    </div>
</template>
