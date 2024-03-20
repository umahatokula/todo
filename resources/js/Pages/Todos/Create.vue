<template>
    <div class="container p-4 mx-auto">
        <form @submit.prevent="submit">
            <div v-if="!todo.title" class="mb-4">
                <input
                    v-model="newTodo"
                    type="text"
                    placeholder="Enter Todo title"
                    class="p-2 border rounded"
                />
                <button
                    @click="addTodo"
                    class="px-4 py-2 ml-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700"
                >
                    Set Todo Title
                </button>
            </div>

            <div v-if="todo.title" class="mb-4">
                <div class="p-2 bg-gray-100 rounded">
                    <h2 class="font-bold">{{ todo.title }}</h2>
                    <div class="mt-2">
                        <input
                            v-model="newItemContent"
                            type="text"
                            placeholder="Add a new item"
                            class="p-2 border rounded"
                        />
                        <button
                            type="button"
                            @click="addItem"
                            class="px-4 py-2 ml-2 font-bold text-white bg-green-500 rounded hover:bg-green-700"
                        >
                            Add Item
                        </button>
                    </div>

                    <ul class="mt-2">
                        <li
                            v-for="(item, index) in todo.items"
                            :key="index"
                            class="flex items-center p-1"
                        >
                            <input
                                type="checkbox"
                                v-model="item.is_completed"
                                class="mr-2"
                            />
                            <span
                                :class="{ 'line-through': item.is_completed }"
                                >{{ item.content }}</span
                            >
                        </li>
                    </ul>
                </div>
            </div>

            <button type="submit">Save</button>
        </form>
    </div>
</template>

<script>
import { ref } from "vue";
import { router } from '@inertiajs/vue3'

export default {
    setup() {
        const newTodo = ref("");
        const newItemContent = ref("");
        const todo = ref({
            title: "",
            items: [],
        });

        function submit() {
            router.post("/api/todos", todo.value);
        }

        const addTodo = () => {
            if (!newTodo.value) return;
            todo.value.title = newTodo.value;
            newTodo.value = ""; // Clear the input after setting the title
        };

        const addItem = () => {
            if (!newItemContent.value) return;
            todo.value.items.push({
                content: newItemContent.value,
                is_completed: false,
            });
            newItemContent.value = ""; // Clear the input after adding the item
        };

        return {
            newTodo,
            newItemContent,
            todo,
            addTodo,
            addItem,
            submit,
        };
    },
};
</script>

<style scoped></style>
