<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-60 transition-opacity backdrop-blur-sm">
        <div class="bg-white rounded-xl shadow-2xl w-full max-w-lg mx-4 transform transition-all p-6 relative">
            
            <div class="absolute top-4 right-4">
                <button @click="$emit('close')" class="text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full p-1 transition-colors focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
            
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-gray-900">{{ title }}</h3>
                <p class="text-gray-500 text-sm mt-1">Fill out the details below.</p>
            </div>
            
            <form @submit.prevent="$emit('submit', form)">
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Task Title <span class="text-red-500">*</span></label>
                    <input v-model="form.title" type="text" placeholder="E.g. Schedule meeting with HR" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow" required>
                    <p v-if="errors && errors.title" class="text-red-500 text-xs mt-2">{{ errors.title }}</p>
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Description <span class="text-red-500">*</span></label>
                    <textarea v-model="form.description" rows="4" placeholder="Briefly describe what this task is about..." class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-shadow" required></textarea>
                    <p v-if="errors && errors.description" class="text-red-500 text-xs mt-2">{{ errors.description }}</p>
                </div>
                
                <div class="mb-6 p-4 bg-gray-50 rounded-lg border border-gray-100 flex items-center" v-if="isEdit">
                    <input v-model="form.completed" :value="true" type="checkbox" class="h-5 w-5 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded cursor-pointer">
                    <label class="ml-3 block text-sm font-medium text-gray-800 cursor-pointer">Mark this task as completed</label>
                </div>
                
                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <button type="button" @click="$emit('close')" class="px-5 py-2.5 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-200 transition-all font-medium">Cancel</button>
                    <button type="submit" :disabled="form.processing" class="px-5 py-2.5 border border-transparent rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all font-medium flex items-center justify-center min-w-[100px] disabled:opacity-75 disabled:cursor-not-allowed">
                        <span v-if="form.processing" class="mr-2 loader"></span> 
                        {{ submitLabel }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
defineProps({
    show: Boolean,
    title: String,
    submitLabel: String,
    form: Object,
    errors: {
        type: Object,
        default: () => ({})
    },
    isEdit: {
        type: Boolean,
        default: false
    }
});
defineEmits(['close', 'submit']);
</script>
<style scoped>
.loader {
    border: 2px solid rgba(255,255,255, 0.3);
    border-radius: 50%;
    border-top: 2px solid white;
    width: 14px;
    height: 14px;
    -webkit-animation: spin 1s linear infinite;
    animation: spin 1s linear infinite;
}
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>
