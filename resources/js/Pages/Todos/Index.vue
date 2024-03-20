<template>
    <div class="container p-4 mx-auto">
        <Link href="/create">Create TODO</Link>
        <div v-for="todo in todos" :key="todo.id" class="mb-8">
            <div class="p-4 bg-gray-100 rounded-lg">
                <h3 class="mb-2 text-xl font-bold">{{ todo.title }}</h3>
                <ul>
                    <li
                        v-for="item in todo.items"
                        :key="item.id"
                        class="flex items-center mb-1"
                    >
                        <input
                            type="checkbox"
                            v-model="item.is_completed"
                            class="mr-2"
                            @change="() => toggleCompletion(todo.id, item.id)"
                        />
                        <span
                            :class="{
                                'line-through': item.is_completed,
                                'text-gray-600': !item.is_completed,
                            }"
                            >{{ item.content }}</span
                        >
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { Link } from '@inertiajs/vue3'

defineProps({ todos: Object });

const toggleCompletion = (todoId, itemId) => {
    const todo = todos.value.find((t) => t.id === todoId);
    const item = todo.items.find((i) => i.id === itemId);
    item.is_completed = !item.is_completed;
};
</script>

<style scoped></style>
