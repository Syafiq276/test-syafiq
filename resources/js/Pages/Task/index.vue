<template>
    <div class="min-h-screen bg-gray-50 flex flex-col font-sans">
        <Header />

        <main class="flex-grow container mx-auto px-4 py-8 max-w-4xl">
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">My Tasks</h2>
                        <p class="text-sm text-gray-500 mt-1">Manage your day effectively.</p>
                    </div>
                    <button @click="openCreateModal" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition-colors shadow flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        New Task
                    </button>
                </div>

                <div v-if="tasks.length === 0" class="p-12 text-center">
                    <div class="w-16 h-16 bg-indigo-50 text-indigo-500 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No tasks yet</h3>
                    <p class="text-sm text-gray-500 mt-1">Get started by creating a new task.</p>
                </div>

                <ul v-else class="divide-y divide-gray-100">
                    <li v-for="task in tasks" :key="task.id" class="p-6 hover:bg-gray-50 transition-colors flex flex-col sm:flex-row gap-4 sm:items-center justify-between group">
                        <div class="flex items-start flex-1 min-w-0">
                            <div class="flex-shrink-0 mt-1 mr-4">
                                <div :class="[task.completed ? 'bg-green-100 text-green-600' : 'bg-amber-100 text-amber-600', 'p-2 rounded-full']">
                                    <svg v-if="task.completed" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h4 :class="[task.completed ? 'text-gray-500 line-through' : 'text-gray-900', 'text-lg font-semibold truncate']">{{ task.title }}</h4>
                                <p class="text-gray-600 text-sm mt-1 mb-2 whitespace-pre-wrap">{{ task.description }}</p>
                                <span class="text-xs font-medium px-2.5 py-1 rounded-full border" :class="task.completed ? 'bg-green-50 border-green-200 text-green-700' : 'bg-amber-50 border-amber-200 text-amber-700'">
                                    {{ task.completed ? 'Completed' : 'Pending' }}
                                </span>
                                <span class="text-xs text-gray-400 ml-3">Created {{ new Date(task.created_at).toLocaleDateString() }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0 flex gap-2 opacity-100 sm:opacity-0 group-hover:opacity-100 transition-opacity">
                            <button @click="openEditModal(task)" class="p-2 text-indigo-600 bg-indigo-50 hover:bg-indigo-100 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            </button>
                            <button @click="deleteTask(task.id)" class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-red-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        </main>

        <Footer />

        <TaskModal
            :show="showModal"
            :title="modalTitle"
            :submit-label="modalSubmitLabel"
            :form="form"
            :errors="form.errors"
            :is-edit="isEdit"
            @close="closeModal"
            @submit="submitForm"
        />
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import Header from '@/Components/Header.vue';
import Footer from '@/Components/Footer.vue';
import TaskModal from '@/Components/TaskModal.vue';

const props = defineProps({
    tasks: Array
});

const showModal = ref(false);
const isEdit = ref(false);
const editingTaskId = ref(null);
const modalTitle = ref('');
const modalSubmitLabel = ref('');

const form = useForm({
    title: '',
    description: '',
    completed: false
});

const openCreateModal = () => {
    isEdit.value = false;
    modalTitle.value = 'Create New Task';
    modalSubmitLabel.value = 'Create';
    form.reset();
    form.clearErrors();
    showModal.value = true;
};

const openEditModal = (task) => {
    isEdit.value = true;
    editingTaskId.value = task.id;
    modalTitle.value = 'Edit Task';
    modalSubmitLabel.value = 'Save Changes';
    form.reset();
    form.clearErrors();
    form.title = task.title;
    form.description = task.description;
    form.completed = !!task.completed;
    showModal.value = true;
};

const closeModal = () => {
    showModal.value = false;
    form.reset();
    form.clearErrors();
};

const submitForm = () => {
    if (isEdit.value) {
        form.put(route('task.update', editingTaskId.value), {
            onSuccess: () => closeModal(),
        });
    } else {
        form.post(route('task.store'), {
            onSuccess: () => closeModal(),
        });
    }
};

const deleteTask = (id) => {
    if (confirm('Are you sure you want to delete this task? This action cannot be undone.')) {
        router.delete(route('task.destroy', id), {
            preserveScroll: true
        });
    }
};
</script>