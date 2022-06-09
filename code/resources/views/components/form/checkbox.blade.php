<div class="mb-6 text-center form-group form-check">
    <input {{ $attributes }} type="checkbox"
        class="w-4 h-4 mt-1 mr-2 align-top transition duration-200 bg-white bg-center bg-no-repeat bg-contain border border-gray-300 rounded-sm appearance-none cursor-pointer form-check-input checked:bg-blue-600 checked:border-blue-600 focus:outline-none"
        >
    <label class="inline-block text-gray-800 form-check-label" for="exampleCheck25">{{ $slot }}</label>
</div>