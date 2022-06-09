<!-- Modal -->

<div class="fixed top-0 left-0 w-full h-full mx-auto overflow-x-hidden overflow-y-auto outline-none xhidden modal fade"
    x-data="{
        show:true
    }"
    xx-on:keydown.escape.window="show = false"
    xx-show="show"
    id="exampleModal" tabindex="-1" >

    <div class="relative mx-auto pointer-events-none w-96 modal-dialog">
        <div
            class="relative flex flex-col w-full text-current bg-green-300 border-none rounded-md shadow-lg outline-none pointer-events-auto modal-content bg-clip-padding">
            <div class="flex items-center justify-between flex-shrink-0 p-4 border-b border-gray-200 modal-header rounded-t-md">
                <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">{{ $title }}</h5>
                <button class="box-content w-4 h-4 p-1 text-black border-none rounded-none opacity-50 btn-close focus:shadow-none focus:outline-none focus:opacity-100 hover:text-black hover:opacity-75 hover:no-underline"
                    type="button" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="relative p-4 modal-body">
                slot
            </div>
            <div class="flex flex-wrap items-center justify-end flex-shrink-0 p-4 border-t border-gray-200 modal-footer rounded-b-md">
                <button type="button" class="px-6 py-2 text-xs font-medium leading-tight text-gray-700 uppercase transition duration-150 ease-in-out bg-gray-200 rounded shadow-md hover:bg-gray-200 hover:shadow-lg focus:bg-gray-200 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-gray-200 active:shadow-lg" data-bs-dismiss="modal">Close</button>
                <button type="button" class="px-6 py-2 ml-1 text-xs font-medium leading-tight text-white uppercase transition duration-150 ease-in-out bg-blue-600 rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg">Save changes</button>
            </div>
        </div>
    </div>

</div>

