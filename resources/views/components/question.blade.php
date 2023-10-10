@props(['question'])



<div class="rounded dark:bg-gray-800/50 shadow shadow-blue-500/50 p-3 dark:text-gray-400 flex justify-between items-center">
   <span>
       {{ $question->question }}
   </span>
    <div class="flex space-x-3">
        <x-form :action="route('question.like', $question)">
            <button class="text-green-500">
                <x-icons.thumbs-up class="w-5 h-6 hover:text-green-300 cursor-pointer" />
                {{ $question->likes }}
            </button>
        </x-form>
        <x-form :action="route('question.unlike', $question)">
            <button class="text-red-500">
                <x-icons.thumbs-up class="w-5 h-6 hover:text-red-300 cursor-pointer" />
                {{ $question->unlikes }}
            </button>
        </x-form>
    </div>
</div>

