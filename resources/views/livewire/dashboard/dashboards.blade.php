<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    {{-- <div class="sm:flex sm:justify-between sm:items-center mb-3">

    </div> --}}
    <div class="col-span-2 p-1" id="layout_scan">
        <div id="reader" style="width: 100%; "></div>
    </div>
    <div class="p-0">
        <div class="bg-white p-2">
            <div class="grid grid-cols-6 gap-6">
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="name" value="Kode Barang *" />
                    <input type="text" readonly class="bg-gray-300 mt-1 block w-full" wire:model="kode_barang"/>
                    <x-jet-input-error for="kode_barang" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="tgl" value="Nama Barang *" />
                    <input type="text" readonly class="bg-gray-300 mt-1 block w-full" wire:model="nama_barang"/>
                    <x-jet-input-error for="nama_barang" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="tgl" value="Asal Laboraturium *" />
                    <select class="bg-white mt-1 block w-full" wire:model="labory_id">
                        <option value="">--Pilih Asal--</option>
                        @if ($option_labory)
                            @foreach ($option_labory as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    <x-jet-input-error for="labory_id" class="mt-2" />
                </div>
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="tgl" value="Jam Mulai *" />
                    <input type="time" class="bg-white mt-1 block w-full" wire:model="time_start"/>
                    <x-jet-input-error for="time_start" class="mt-2" />
                </div>
                <div class="col-span-3 sm:col-span-3">
                    <x-jet-label for="tgl" value="Jam Selesai" />
                    <input type="time" class="bg-white mt-1 block w-full" wire:model="time_end"/>
                    <x-jet-input-error for="time_end" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="tgl" value="Nama Kegiatan*" />
                    <input type="text" class="bg-white mt-1 block w-full" wire:model="activity"/>
                    <x-jet-input-error for="activity" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-6">
                    <x-jet-label for="tgl" value="Deskripsi *" />
                   <textarea class="bg-white mt-1 block w-full" cols="10" rows="5"  wire:model="description"></textarea>
                    <x-jet-input-error for="description" class="mt-2" />
                </div>
                <div class="col-span-6 sm:col-span-6">
                    {{-- @if ($can_submit) --}}
                        <button wire:click.prevent="store" type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent
                        px-4 py-2 bg-green-700 text-base leading-6 font-medium text-white shadow-sm
                        hover:bg-green-500 focus:outline-none focus:border-green-700 
                        focus:shadow-outline-green transition ease-in-out duration-150
                        sm:text-sm sm:leading-5">
                            SIMPAN
                        </button>
                    {{-- @else  
                    <button type="button"
                            class="inline-flex justify-center w-full rounded-md border border-transparent
                        px-4 py-2 bg-green-400 text-base leading-6 font-medium text-white shadow-sm
                        hover:bg-green-400 focus:outline-none focus:border-green-400 
                        focus:shadow-outline-green transition ease-in-out duration-150
                        sm:text-sm sm:leading-5">
                            MOHON SCAN BARANG
                        </button>
                    @endif --}}
                   
                </div>

            </div>
        </div>
    </div>


</div>

@push('scripts')
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        

        function onScanSuccess(decodedText, decodedResult) {
            // alert(decodedText);
            let id = decodedText;
            html5QrcodeScanner.clear().then(_ => {
                // alert('QR Code berhasil terbaca');
                // $('#layout_scan').hide();
                window.livewire.emit('scan', id);

            }).catch(error => {
                alert('something wrong', error);
            });

        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(Code scan error = ${error});
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endpush