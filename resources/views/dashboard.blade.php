<x-app-layout>
    <x-slot name="header">
        <x-header>
            {{ __('Dashboard') }}
        </x-header>
    </x-slot>

    <x-container>
        <x-form :action="route('question.store')" post>
            <x-textarea name="question" label="Question" />  
            <x-btn.primary>Save</x-btn.primary>
            <x-btn.reset>Reset</x-btn.reset>
        </x-form>
    

        <hr class="border-gray-700 border-dashed my-4">

        <div class="dark:text-gray-400 uppercase font-bold mb-1">List of Questions</div>

        <div class="dark:text-gray-400 space-y-4">
            @foreach ($questions as $question)
                <x-question :question="$question" />
            @endforeach
        </div>
    </x-container>
</x-app-layout>
