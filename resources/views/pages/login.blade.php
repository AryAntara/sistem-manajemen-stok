@extends('layouts.default')

@section('content')
    <div class="w-100% flex justify-center h-screen">

        <div class="w-1/2 bg-[#368D5B] h-full flex justify-center items-center">
            <img class="object-cover w-72 h-72" src="{{ asset('images/logo.png') }}">
        </div>
        <div class="w-1/2 flex justify-center flex-col items-center h-full">
            <form method="POST">
                @csrf
                <div class="flex flex-col items-center w-[600px]">
                    <h2 class="text-center my-8 font-bold text-[32px]">MASUK</h2>

                    {{-- Error Wrapper --}}
                    @if ($errors->first())
                        <div class="my-2 bg-red-400 w-[400px] p-2 rounded-full flex items-center">
                            <i class="ms-1 text-[20px] text-white bi bi-info-circle-fill">

                            </i><p class="text-white ps-3">{{ $errors->first() }}</p>
                        </div>
                    @endif
                    <div class="my-2">
                        <input name="username"
                            class="w-[400px] bg-[#050505] outline-none border p-2 px-4 rounded-full text-gray-100"
                            type="text" id="username" placeholder="Masukan Username" value="{{ old('username') }}">
                    </div>
                    <div class="my-2">

                        <div class="w-[400px] flex" x-data="{
                            visible: false,
                            type: 'password',
                            valuePassword: '',
                            toggle() {
                                this.visible = !this.visible;
                                this.type = this.visible ? 'text' : 'password';
                            }
                        }">
                            <input name="password"
                                class="w-[350px] outline-none bg-[#050505] p-2 px-4 rounded-s-full text-gray-100"
                                :type='type' id="password" value='' placeholder="Masukan Password">

                            {{-- toggle password visible --}}
                            <div class="w-[50px] bg-[#050505] flex justify-center items-center rounded-e-full "
                                x-on:click="toggle">
                                {{-- icon eye --}}
                                <svg x-cloak x-show="visible" x-transition xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" class="bi bi-eye fill-white" viewBox="0 0 16 16">
                                    <path
                                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                    <path
                                        d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                </svg>

                                {{-- icon eye slash --}}
                                <svg x-cloak x-show="!visible" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" class="bi bi-eye-slash fill-white" viewBox="0 0 16 16">
                                    <path
                                        d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                                    <path
                                        d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                                    <path
                                        d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                                </svg>
                            </div>

                        </div>

                    </div>
                    <div class="my-2">
                        <button class="w-[400px] bg-[#94C0AC] hover:bg-[#368D5B] p-2 text-white rounded-full" x-text="valuePassword">Masuk</button>
                    </div>
                    <a href="" class="text-center text-gray-500 mt-4">Engsap ajak password?</a>
                </div>
            </form>
        </div>
    </div>
@endsection
