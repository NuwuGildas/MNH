<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>mhn</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <link rel="stylesheet" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.dataTables.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!--Replace with your tailwind.css once created-->
    <link rel="stylesheet" href="{{asset('css/chartist.min.css')}}">
    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('js/alpine.min.js')}}" defer></script>
</head>

<body class="bg-gray-100 font-sans">
    <!-- <div id="loader" class="w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50">
  <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block absolute w-0 h-0" style="left:35%; top: 40%;">
    <i class="fas fa-circle-notch fa-spin fa-5x"></i>
  </span>
</div> -->

    <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center z-50">
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl main-color font-bold">Transaction</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                            <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <div id="debit" class="shadow-xl p-10 bg-white max-w-xl rounded">
                    <h1 id="textD" class="text-4xl text-indigo-500 font-black mb-4">Debit</h1>
                    <h1 id="textC" class="text-4xl text-indigo-500 main-color font-black mb-4 hidden">Credit</h1>
                    <form id="formDebit" action="{{ route('login') }}" method="post">
                        @csrf
                        <input type="hidden" name="hidden" id="hidden">
                        <div id="toggle" class="mb-4 relative">
                            <!-- Toggle Button -->
                            <label for="toogleA" class="flex items-center cursor-pointer">
                                <!-- toggle -->
                                <div class="relative">
                                    <!-- input -->
                                    <input id="toogleA" name="toggle" type="checkbox" class="hidden" />
                                    <!-- line -->
                                    <div class="toggle__line w-10 h-4 bg-gray-400 rounded-full shadow-inner"></div>
                                    <!-- dot -->
                                    <div class="toggle__dot absolute w-6 h-6 bg-indigo-600 rounded-full shadow inset-y-0 left-0"></div>
                                </div>
                                <!-- label -->
                                <div class=" text-gray-700 font-medium"></div>
                            </label>
                        </div>
                        <div id="divC" class="mb-4 relative hidden">
                            <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-yellow-600 focus:outline-none active:outline-none active:border-yellow-600 " name="credit_amount" id="inputC" type="text" autofocus>
                            <label for="email" class="label absolute mb-0 -mt-2 pt-4 pl-3 leading-tighter main-color text-base mt-2 cursor-text">Montant Credit</label>
                        </div>
                        <div id="divD" class="mb-4 relative ">
                            <input class="input border border-gray-400 appearance-none rounded w-full px-3 py-3 pt-5 pb-2 focus focus:border-indigo-600 focus:outline-none active:outline-none active:border-indigo-600" name="debit_amount" id="inputD" type="text" autofocus>
                            <label for="password" class="label absolute mb-0 -mt-2 pt-4 pl-3 leading-tighter text-gray-400 text-base mt-2 cursor-text">Montant Debit</label>
                        </div>
                        <button id="submitDebit" class="bg-indigo-600 hover:bg-blue-dark text-white font-bold py-3 px-6 rounded">Submit</button>
                    </form>
                </div>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <button class="modal-close px-4 main-color-bg p-3 rounded-lg text-white hover:bg-gray-100 hover:text-indigo-400 mr-2">close</button>
                    <!-- <button class="modal-close px-4 bg-indigo-500 p-3 rounded-lg text-white hover:bg-indigo-400">Credit</button> -->
                </div>

            </div>
        </div>
    </div>


    @if( Auth::user()->confirm_account == 0)
    <div id="transaction" class="fixed flex flex-col justify-center w-full h-screen items-center z-50 " style="background: url('img/bgM.svg');">
        <!-- Information Modal -->
        <div class="md:w-1/3 sm:w-full rounded-lg shadow-lg bg-white my-3 slide-in-bottom">
            <div class="flex justify-between border-b border-gray-100 px-5 py-4">
                <div>
                    <i class="fa fa-exclamation-triangle text-orange-500"></i>
                    <span class="font-bold text-gray-700 text-lg">Transaction</span>
                </div>
                <!-- <div>
              <button onclick="cancel()"><i class="fa fa-times-circle text-red-500 bounce-top-icons hover:text-red-600 transition duration-150"></i></button>
          	</div> -->
            </div>

            <div class="px-10 py-5 text-gray-600">
                click sur send pour terminer l'inscription en envoyant un @if( Auth::user()->paiement == 'Orange money') Orange money @endif @if( Auth::user()->paiement == 'MTN Mobile Money') MTN Mobile money @endif de {{Auth::user()->amount}} FcFa
                <p class="main-color">si vous avez déja valider, veuillez attendre la confirmation</p>
            </div>

            <div class="px-5 py-4 flex justify-center">
                @if( Auth::user()->paiement == 'Orange money')<a href="tel:#150*1*1*695719695*{{Auth::user()->amount}}#" class="bg-orange-500 mr-1 rounded text-sm py-2 px-3 text-white hover:bg-orange-600 transition duration-150">Send</a>@endif
                @if( Auth::user()->paiement == 'MTN Mobile Money')<a href="tel:*126*1*672691782* {{Auth::user()->amount}} #" class="bg-orange-500 mr-1 rounded text-sm py-2 px-3 text-white hover:bg-orange-600 transition duration-150">Send</a> @endif
                <!--  <button onclick="cancel()" class="text-sm py-2 px-3 text-gray-500 hover:text-gray-600 transition duration-150">Cancel</button> -->
            </div>
        </div>

    </div>
    @endif
    @if( Auth::user()->confirm_account == 0)
    <div class="hidden">
        @endif
        @if( Auth::user()->confirm_account == 1)
        <div id="mainBody">
            @endif
            <div id="mainDiv" class="border-b border-indigo-darkest bg-teal py-4 px-2">
                <div id="navbar" class="fixed h-14 top-0 w-full bg-white" style="left:0; z-index: 99999;transition: background 1.4s ease-in-out;">
                    <nav class="flex items-center justify-between flex-wrap">
                        <div class="flex items-center flex-no-shrink main-color mr-6">
                            <img src="img/fdfsd.png" class=" h-12 w-14 mr-2 text--blue-500 pr-2" alt="" srcset="">
                            <span class="font-semibold text-xl tracking-tight ">MNH</span>
                        </div>
                        <div class="block sm:hidden">
                            <button class="navbar-burger flex items-center px-3 py-2 border rounded main-color border-white hover:text-white hover:border-white hover:bg-orange-400">
                                <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <title>Menu</title>
                                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" />
                                </svg>
                            </button>
                        </div>
                        <div id="main-nav" class="w-full flex-grow sm:flex items-center sm:w-auto hidden text-right">
                            <div class="text-sm sm:flex-grow main-color">
                                <a href="#" class="no-underline font-bold block mt-4 sm:inline-block sm:mt-0 text-grey-lighter hover:text-grey-light mr-4">
                                    {{ Auth::user()->name }}
                                </a>
                            </div>
                            <div class="text-right">
                                <a href="{{ route('logout') }}" class="main-color no-underline inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal hover:bg-white lg:mt-0" onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                    logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>

                        </div>
                    </nav>
                </div>
            </div>
            <div class="flex flex-col justify-center items-center">

                <div class="sliderAx w-full" style="height: 370px;">
                    <div id="slider-1" class="container h-full mx-auto">
                        <div class="bg-cover bg-center  h-full text-white py-24 px-10 object-fill" style="background-image: url({{asset('img/slide1.jpg')}})">
                            <div class="md:w-1/2">
                                <p class="font-bold text-sm uppercase"></p>
                                <p class="text-3xl font-bold">MNH INVESTMENT</p>
                                <p class="text-2xl mb-10 leading-none">J'investis pour un Avenir meilleur</p>
                                <a href="http://wa.me/237699648860" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contactez nous</a>
                            </div>
                        </div> <!-- container -->
                        <br>
                    </div>

                    <div id="slider-2" class="container mx-auto">
                        <div class="bg-cover bg-top  h-auto text-white py-24 px-10 object-fill" style="background-image: url(https://images.unsplash.com/photo-1544144433-d50aff500b91?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80)">

                            <p class="font-bold text-sm uppercase">Services</p>
                            <p class="text-3xl font-bold">MNH INVESTMENT</p>
                            <p class="text-2xl mb-10 leading-none">Je Garantis Mon Avenir</p>
                            <a href="http://wa.me/237699648860" class="bg-purple-800 py-4 px-8 text-white font-bold uppercase text-xs rounded hover:bg-gray-200 hover:text-gray-800">Contactez nous</a>

                        </div> 
                        <br>
                    </div> 
                </div>
                <div class="flex justify-between w-12 mx-auto pb-2">
                    <button id="sButton1" onclick="sliderButton1()" class="bg-purple-400 rounded-full w-4 pb-2 "></button>
                    <button id="sButton2" onclick="sliderButton2() " class="bg-purple-400 rounded-full w-4 p-2"></button>
                </div>


            </div>
            <div class="border-b p-3">
                <h5 class="text-center main-color">Bienvenue {{ Auth::user()->name }} votre Bosscode est <h1 class="text-center font-bold  main-color">{{ Auth::user()->boss_code }}</h1>
                </h5>
            </div>
            <div id="dash-content" class="bg-gray-200 py-2 lg:py-0 w-full sm:w-full  inline-flex sm:h-64 overflow-x-scroll overflow-y-none">

                <div class="w-1/2 lg:w-full" id="wallet" onclick="Mywallet('{{ Auth::user()->id }}')">
                    <div class="border-2 hover:border-gray-400  hover:border-dashed border-transparent bg-white shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                        <div class="flex flex-col items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-3 bg-gray-300"><i class="fa fa-wallet fa-fw fa-inverse text-indigo-500 hover:main-color"></i></div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-3xl">{{ Auth::user()->current_amount }} <span class="text-green-500"><i class="fas fa-caret-up"></i></span></h3>
                                <h5 class="font-bold main-color">Revenue</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-1/2 lg:w-full" id="{{Auth::user()->boss_code}}" onclick="preBoss(this)">
                    <div class="border-2 hover:border-gray-400 hover:border-dashed border-transparent bg-white shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                        <div class="flex flex-col items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-3 bg-gray-300"><i class="fas fa-users fa-fw fa-inverse text-indigo-500"></i></div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-3xl">{{ Auth::user()->preboss }}<span class="text-orange-500"><i class="fas fa-exchange-alt"></i></span></h3>
                                <h5 class="font-bold main-color">PreBoss</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-1/2 lg:w-full " onclick="injectorBoss('{{ Auth::user()->boss_code }}')">
                    <div class="border-2 hover:border-gray-400 hover:border-dashed border-transparent bg-white shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                        <div class="flex flex-col items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-3 bg-gray-300"><i class="fas fa-user-plus fa-fw fa-inverse text-indigo-500"></i></div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-3xl">{{ Auth::user()->injector_boss }}<span class="text-yellow-600"><i class="fas fa-caret-up"></i></span></h3>
                                <h5 class="font-bold main-color">Injector Boss</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @if( Auth::user()->amount > 99000)
                <div class="w-1/2 lg:w-full" onclick="advancedBoss('{{ Auth::user()->id }}')">
                    <div class="border-2 hover:border-gray-400 hover:border-dashed border-transparent bg-white shadow-xl rounded p-6 m-2 md:mx-10 md:my-6">
                        <div class="flex flex-col items-center">
                            <div class="flex-shrink pr-4">
                                <div class="rounded-full p-3 bg-gray-300"><i class="fas fa-server fa-fw fa-inverse text-indigo-500"></i></div>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-bold text-3xl">{{ Auth::user()->advanced_boss}}</h3>
                                <h5 class="font-bold main-color">Advanced Boss</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>


            <div class="container w-full md:w-4/5 xl:w-3/5  mx-auto px-2">
                @if( Auth::user()->role == 'admin')
                <div class="border-b p-3">
                    <h5 class="font-bold main-color">TOUS LES UTILISATEURS </h5>
                </div>
                <!--Card-->
                <div id='recipients' class="p-8 mt-6 lg:mt-0 rounded shadow bg-white">

                    <table id="example" class="stripe hover" style="width:100%; padding-top: 1em;  padding-bottom: 1em;">
                        <thead>
                            <tr>
                                <th data-priority="1">image</th>
                                <th data-priority="2">first_name</th>
                                <th data-priority="3">age</th>
                                <th data-priority="5">city</th>
                                <th data-priority="4">profession</th>
                                <th data-priority="4">telephone</th>
                                <th data-priority="6">amount</th>
                                <th data-priority="6">paiement</th>
                                <th data-priority="6">action</th>
                            </tr>
                        </thead>

                        <!-- Rest of your data (refer to https://datatables.net/examples/server_side/ for server side processing)-->

                    </table>


                </div>
                <!--/Card-->
                @endif
                <!--Graph Content -->
                <div id="main-content" class="w-full flex-1">
                    @if( Auth::user()->role == 'admin')
                    <div x-data="app()" x-cloak class="px-4 hidden">
                        <div class="max-w-lg mx-auto py-10">
                            <div class="shadow p-6 rounded-lg bg-white">
                                <div class="md:flex md:justify-between md:items-center">
                                    <div>
                                        <h2 class="text-xl text-gray-800 font-bold leading-tight">Product Sales</h2>
                                        <p class="mb-2 text-gray-600 text-sm">Monthly Average</p>
                                    </div>

                                    <!-- Legends -->
                                    <div class="mb-4">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 bg-blue-600 mr-2 rounded-full"></div>
                                            <div class="text-sm text-gray-700">Sales</div>
                                        </div>
                                    </div>
                                </div>


                                <div class="line my-8 relative">
                                    <!-- Tooltip -->
                                    <template x-if="tooltipOpen == true">
                                        <div x-ref="tooltipContainer" class="p-0 m-0 z-10 shadow-lg rounded-lg absolute h-auto block" :style="`bottom: ${tooltipY}px; left: ${tooltipX}px`">
                                            <div class="shadow-xs rounded-lg bg-white p-2">
                                                <div class="flex items-center justify-between text-sm">
                                                    <div>Sales:</div>
                                                    <div class="font-bold ml-2">
                                                        <span x-html="tooltipContent"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>

                                    <!-- Bar Chart -->
                                    <div class="flex -mx-2 items-end mb-2">
                                        <template x-for="data in chartData">

                                            <div class="px-2 w-1/6">
                                                <div :style="`height: ${data}px`" class="transition ease-in duration-200 bg-blue-600 hover:bg-blue-400 relative" @mouseenter="showTooltip($event); tooltipOpen = true" @mouseleave="hideTooltip($event)">
                                                    <div x-text="data" class="text-center absolute top-0 left-0 right-0 -mt-6 text-gray-800 text-sm"></div>
                                                </div>
                                            </div>

                                        </template>
                                    </div>

                                    <!-- Labels -->
                                    <div class="border-t border-gray-400 mx-auto" :style="`height: 1px; width: ${ 100 - 1/chartData.length*100 + 3}%`"></div>
                                    <div class="flex -mx-2 items-end">
                                        <template x-for="data in labels">
                                            <div class="px-2 w-1/6">
                                                <div class="bg-red-600 relative">
                                                    <div class="text-center absolute top-0 left-0 right-0 h-2 -mt-px bg-gray-400 mx-auto" style="width: 1px"></div>
                                                    <div x-text="data" class="text-center absolute top-0 left-0 right-0 mt-3 text-gray-700 text-sm"></div>
                                                </div>
                                            </div>
                                        </template>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

            </div>
        </div>
        <!--  -->
        <div id="modalMain" class="slide-in-bottom fixed pin z-50 h-screen w-full smoke-dark flex hidden" style="margin-top: 48px;">

            <div class="relative bg-white bg-transparent h-full w-full max-w-md m-auto flex-col flex">

                <div class="fixed pin max-w-md text-center text-white m-auto z-50 bounce-top-icons main-color-bg h-48 w-full lg:mx-auto flex-col flex">
                    <span>
                        <h2 id="modalName">wallet</h2>
                    </span>
                    <span id="closeM" class="absolute fade-in pin-t pin-r text-white ">
                        <svg class="h-10 w-10 fill-current text-grey hover:text-grey-darkest" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Close</title>
                            <path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                    <p class=" font-sans text-lg inline-block align-middle m-auto">
                        <h4 id="currency" class="font-thin text-4xl">FCFA</h4>
                        <h1 id="number" class="font-semibold text-6xl">0</h1>
                    </p>
                </div>
                <div id="content" class="container bg-transparent mt-48 overflow-auto">

                </div>
            </div>

        </div>
        <div id="profile_modal" style="position: fixed; background-color:#242424c2;" class="fade-in z-50 h-screen w-screen flex justify-center items-center hidden">
            <!-- <div class="w-screen h-screen flex justify-center items-center"> -->
            <div class="container mx-auto max-w-sm rounded-lg overflow-hidden shadow-lg my-2 bg-white">
                <div class="relative z-10" style="clip-path: polygon(0 0, 100% 0, 100% 100%, 0 calc(100% - 5vw));">
                    <img id="profile_img" class="w-full" src="{{asset('img/slide1.jpg')}}" alt="Profile image" />
                    <div class="text-center absolute w-full" style="bottom: 4rem">
                        <p class="text-white tracking-wide uppercase text-lg font-bold" style="text-align: right;" id="profile_name"></p>
                        <p class="text-white tracking-wide text-sm" id="profile_surname" style="text-align: right;" ></p>
                    </div>
                </div>
                <div class="relative flex justify-between items-center flex-row px-6 z-50 -mt-10">
                    <p id="profile_invalide" class="flex items-center text-gray-400"  style="color:#738297">
                        <span class="inline-block w-3 h-3 bg-red-500 rounded-full mr-2"></span>invalide
                    </p>
                    <p id="profile_valide" class="hidden flex items-center text-gray-400"  style="color:#738297">
                        <span class="inline-block w-3 h-3 bg-green-500 rounded-full mr-2"></span>valide
                    </p>
                    <button class="p-4 bg-red-600 rounded-full hover:bg-red-500 focus:bg-red-700 transition ease-in duration-200 focus:outline-none" onclick="closeB()">
                        <!-- <svg viewBox="0 0 20 20" enable-background="new 0 0 20 20" class="w-6 h-6">
            <path fill="#FFFFFF" d="M16,10c0,0.553-0.048,1-0.601,1H11v4.399C11,15.951,10.553,16,10,16c-0.553,0-1-0.049-1-0.601V11H4.601
                                  C4.049,11,4,10.553,4,10c0-0.553,0.049-1,0.601-1H9V4.601C9,4.048,9.447,4,10,4c0.553,0,1,0.048,1,0.601V9h4.399
                                  C15.952,9,16,9.447,16,10z" />
          </svg> -->
                        <svg viewBox="0 0 365.696 365.696" class="w-6 h-6" xmlns="http://www.w3.org/2000/svg">
                            <path fill="#FFFFFF" d="m243.1875 182.859375 113.132812-113.132813c12.5-12.5 12.5-32.765624 0-45.246093l-15.082031-15.082031c-12.503906-12.503907-32.769531-12.503907-45.25 0l-113.128906 113.128906-113.132813-113.152344c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503907-12.5 32.769531 0 45.25l113.152344 113.152344-113.128906 113.128906c-12.503907 12.503907-12.503907 32.769531 0 45.25l15.082031 15.082031c12.5 12.5 32.765625 12.5 45.246093 0l113.132813-113.132812 113.128906 113.132812c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082031c12.5-12.503906 12.5-32.769531 0-45.25zm0 0" />
                        </svg>
                    </button>
                </div>
                <div class="pt-6 pb-8 text-gray-600 text-center">
                    <p id="profile_amount"></p>
                    <p id="profile_current_amount" class="text-sm"></p>
                </div>

                <div class="pb-10 uppercase text-center tracking-wide flex justify-around hidden">
                    <div class="posts">
                        <p id="profile_role" class="text-gray-400 text-sm">PreBoss</p>
                        <p class="text-lg font-semibold text-blue-300">76</p>
                    </div>
                    <div class="followers">
                        <p class="text-gray-400 text-sm">Followers</p>
                        <p class="text-lg font-semibold text-blue-300">964</p>
                    </div>
                    <div class="following">
                        <p class="text-gray-400 text-sm">Following</p>
                        <p class="text-lg font-semibold text-blue-300">34</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-wrap hidden" style="text-align: justify; text-justify: inter-word;">
            <div class="w-full mx-2 md:w-1/3 lg:w-1/4 flex-1">    
                <div class="max-w-sm my-2 rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{asset('img/house.jpg')}}" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">MNH IMMOBILIER</div>
                        <p class="text-gray-700 text-base">
                            d’aménagement et de déménagement
                            Location d’appartements meublés 
                            ventes et achats de propriétés      
                        </p>
                    </div>
                    <div class="px-6 items-center py-4">
                        <span class="inline-block bg-gray-200 mx-24 bg-indigo-500 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2" style="color: #fff;">plus ...</span>
                    </div>
                </div>
                
            </div>
            <div class="w-full mx-2 md:w-1/3 lg:w-1/4 flex-1">    
                <div class="max-w-sm my-2 rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{asset('img/slide1.jpg')}}" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                        <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet,  Voluptatibus quia, nulla
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#photography</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#travel</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#winter</span>
                    </div>
                </div>
                
            </div>
            <div class="w-full mx-2 md:w-1/3 lg:w-1/4 flex-1">    
                <div class="max-w-sm my-2 rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{asset('img/slide1.jpg')}}" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                        <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet,  Voluptatibus quia, nulla
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#photography</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#travel</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#winter</span>
                    </div>
                </div>
                
            </div>
            <div class="w-full mx-2 md:w-1/2 lg:w-1/4 flex-1">    
                <div class="max-w-sm my-2 rounded overflow-hidden shadow-lg">
                    <img class="w-full" src="{{asset('img/slide1.jpg')}}" alt="Sunset in the mountains">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl mb-2">The Coldest Sunset</div>
                        <p class="text-gray-700 text-base">
                        Lorem ipsum dolor sit amet,  Voluptatibus quia, nulla
                        </p>
                    </div>
                    <div class="px-6 py-4">
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#photography</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">#travel</span>
                        <span class="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700">#winter</span>
                    </div>
                </div>
                
            </div>
        </div>    

        <footer class="fixed bottom-0 w-full lg:hidden bg-white ">
            <div class="flex justify-center border-t-2">

                <a href="http://instagram.com/mnh_group" class="text-gray-700 hover:text-gray-800 m-2  ">
                    <!-- <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M22.46,6C21.69,6.35 20.86,6.58 20,6.69C20.88,6.16 21.56,5.32 21.88,4.31C21.05,4.81 20.13,5.16 19.16,5.36C18.37,4.5 17.26,4 16,4C13.65,4 11.73,5.92 11.73,8.29C11.73,8.63 11.77,8.96 11.84,9.27C8.28,9.09 5.11,7.38 3,4.79C2.63,5.42 2.42,6.16 2.42,6.94C2.42,8.43 3.17,9.75 4.33,10.5C3.62,10.5 2.96,10.3 2.38,10C2.38,10 2.38,10 2.38,10.03C2.38,12.11 3.86,13.85 5.82,14.24C5.46,14.34 5.08,14.39 4.69,14.39C4.42,14.39 4.15,14.36 3.89,14.31C4.43,16 6,17.26 7.89,17.29C6.43,18.45 4.58,19.13 2.56,19.13C2.22,19.13 1.88,19.11 1.54,19.07C3.44,20.29 5.7,21 8.12,21C16,21 20.33,14.46 20.33,8.79C20.33,8.6 20.33,8.42 20.32,8.23C21.16,7.63 21.88,6.87 22.46,6Z" />
                    </svg> -->
                    <svg style="width:24px;height:24px" viewBox="0 0 512.00096 512.00096" xmlns="http://www.w3.org/2000/svg">
                        <path fill="currentColor" d="m373.40625 0h-234.8125c-76.421875 0-138.59375 62.171875-138.59375 138.59375v234.816406c0 76.417969 62.171875 138.589844 138.59375 138.589844h234.816406c76.417969 0 138.589844-62.171875 138.589844-138.589844v-234.816406c0-76.421875-62.171875-138.59375-138.59375-138.59375zm108.578125 373.410156c0 59.867188-48.707031 108.574219-108.578125 108.574219h-234.8125c-59.871094 0-108.578125-48.707031-108.578125-108.574219v-234.816406c0-59.871094 48.707031-108.578125 108.578125-108.578125h234.816406c59.867188 0 108.574219 48.707031 108.574219 108.578125zm0 0" />
                        <path d="m256 116.003906c-77.195312 0-139.996094 62.800782-139.996094 139.996094s62.800782 139.996094 139.996094 139.996094 139.996094-62.800782 139.996094-139.996094-62.800782-139.996094-139.996094-139.996094zm0 249.976563c-60.640625 0-109.980469-49.335938-109.980469-109.980469 0-60.640625 49.339844-109.980469 109.980469-109.980469 60.644531 0 109.980469 49.339844 109.980469 109.980469 0 60.644531-49.335938 109.980469-109.980469 109.980469zm0 0" />
                        <path fill="currentColor" d="m399.34375 66.285156c-22.8125 0-41.367188 18.558594-41.367188 41.367188 0 22.8125 18.554688 41.371094 41.367188 41.371094s41.371094-18.558594 41.371094-41.371094-18.558594-41.367188-41.371094-41.367188zm0 52.71875c-6.257812 0-11.351562-5.09375-11.351562-11.351562 0-6.261719 5.09375-11.351563 11.351562-11.351563 6.261719 0 11.355469 5.089844 11.355469 11.351563 0 6.257812-5.09375 11.351562-11.355469 11.351562zm0 0" />
                    </svg>
                </a>
                <a target="_blank" rel="noopener noreferrer" href="http://www.mnhgroup237.com" class="text-gray-700 hover:text-gray-800 m-2  ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="2" y1="12" x2="22" y2="12"></line>
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path>
                    </svg>
                </a>
                <a href="http://fb.me/mnhgroup" class="text-gray-700 hover:text-gray-800 m-2">
                    <!-- <svg style="width:24px;height:24px" viewBox="0 0 24 24">
                        <path fill="currentColor" d="M12,2A10,10 0 0,0 2,12C2,16.42 4.87,20.17 8.84,21.5C9.34,21.58 9.5,21.27 9.5,21C9.5,20.77 9.5,20.14 9.5,19.31C6.73,19.91 6.14,17.97 6.14,17.97C5.68,16.81 5.03,16.5 5.03,16.5C4.12,15.88 5.1,15.9 5.1,15.9C6.1,15.97 6.63,16.93 6.63,16.93C7.5,18.45 8.97,18 9.54,17.76C9.63,17.11 9.89,16.67 10.17,16.42C7.95,16.17 5.62,15.31 5.62,11.5C5.62,10.39 6,9.5 6.65,8.79C6.55,8.54 6.2,7.5 6.75,6.15C6.75,6.15 7.59,5.88 9.5,7.17C10.29,6.95 11.15,6.84 12,6.84C12.85,6.84 13.71,6.95 14.5,7.17C16.41,5.88 17.25,6.15 17.25,6.15C17.8,7.5 17.45,8.54 17.35,8.79C18,9.5 18.38,10.39 18.38,11.5C18.38,15.32 16.04,16.16 13.81,16.41C14.17,16.72 14.5,17.33 14.5,18.26C14.5,19.6 14.5,20.68 14.5,21C14.5,21.27 14.66,21.59 15.17,21.5C19.14,20.16 22,16.42 22,12A10,10 0 0,0 12,2Z" />
                    </svg> -->
                    <svg style="width:24px;height:24px" height="512pt" fill="currentColor" viewBox="0 0 512 512" width="512pt" xmlns="http://www.w3.org/2000/svg">
                        <path d="m297.277344 508.667969c-2.132813.347656-4.273438.667969-6.421875.960937 2.148437-.292968 4.289062-.613281 6.421875-.960937zm0 0" />
                        <path d="m302.398438 507.792969c-1.019532.1875-2.039063.359375-3.058594.535156 1.019531-.175781 2.039062-.347656 3.058594-.535156zm0 0" />
                        <path d="m285.136719 510.339844c-2.496094.28125-5.007813.53125-7.527344.742187 2.519531-.210937 5.03125-.460937 7.527344-.742187zm0 0" />
                        <path d="m290.054688 509.738281c-1.199219.160157-2.40625.308594-3.609376.449219 1.203126-.140625 2.410157-.289062 3.609376-.449219zm0 0" />
                        <path d="m309.367188 506.410156c-.898438.191406-1.800782.382813-2.703126.566406.902344-.183593 1.804688-.375 2.703126-.566406zm0 0" />
                        <path d="m326.664062 502.113281c-.726562.207031-1.453124.402344-2.179687.605469.726563-.203125 1.453125-.398438 2.179687-.605469zm0 0" />
                        <path d="m321.433594 503.542969c-.789063.207031-1.582032.417969-2.375.617187.792968-.199218 1.585937-.40625 2.375-.617187zm0 0" />
                        <path d="m314.589844 505.253906c-.835938.195313-1.679688.378906-2.523438.566406.84375-.1875 1.6875-.371093 2.523438-.566406zm0 0" />
                        <path d="m277.527344 511.089844c-1.347656.113281-2.695313.214844-4.046875.304687 1.351562-.089843 2.699219-.191406 4.046875-.304687zm0 0" />
                        <path d="m512 256c0-141.363281-114.636719-256-256-256s-256 114.636719-256 256 114.636719 256 256 256c1.503906 0 3-.03125 4.5-.058594v-199.285156h-55v-64.097656h55v-47.167969c0-54.703125 33.394531-84.476563 82.191406-84.476563 23.367188 0 43.453125 1.742188 49.308594 2.519532v57.171875h-33.648438c-26.546874 0-31.6875 12.617187-31.6875 31.128906v40.824219h63.476563l-8.273437 64.097656h-55.203126v189.453125c107.003907-30.675781 185.335938-129.257813 185.335938-246.109375zm0 0" />
                        <path d="m272.914062 511.429688c-2.664062.171874-5.339843.308593-8.023437.398437 2.683594-.089844 5.359375-.226563 8.023437-.398437zm0 0" />
                        <path d="m264.753906 511.835938c-1.414062.046874-2.832031.082031-4.25.105468 1.417969-.023437 2.835938-.058594 4.25-.105468zm0 0" />
                    </svg>
                </a>
            </div>
        </footer>

    </div>
    <script src="{{asset('js/chartist.min.js')}}"></script>
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var mainDiv = document.getElementById('mainDiv');
        var closeM = document.getElementById('closeM');
        var wallet = document.getElementById('wallet');
        var modalMain = document.getElementById('modalMain');
        var toggle = document.getElementById('toogleA');
        //----------modal variables----------
        var container = document.getElementById('content');
        var header = document.getElementById('modalName');
        var currency = document.getElementById('currency');
        var number = document.getElementById('number');
        /* $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '/users',
            dataType: 'json',
            success: function (data) {
                console.log(data.role);
                console.log(data);
                console.log(data.wallet);
                
                construct_UserTable(data,data.role)
            },error:function(data){ 
                console.log(data);
            }
        }); */
        if(false){
            $(document).ready(function () {
                var previousScroll = 0;
                $(window).scroll(function () {
                    var currentScroll = $(this).scrollTop();
                    if (currentScroll < 100) {
                        showTopNav();
                    } else if (currentScroll > 0 && currentScroll < $(document).height() - $(window).height()) {
                        if (currentScroll > previousScroll) {
                            hideNav();
                        } else {
                            showNav();
                        }
                        previousScroll = currentScroll;
                    }
                });

                function hideNav() {
                    $("#navbar").addClass("hidden");
                }

                function showNav() {
                    $("#navbar").removeClass("hidden");
                }
            });
        }

        function closeB() {
            modalMain.classList.toggle('hidden');
            document.getElementById('profile_modal').classList.toggle('hidden');
            document.getElementById('mainBody').classList.toggle('hidden');
            console.log('close');
        }
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: {
                url: "/users"
            },
            columns: [{
                    data: "boss_code",
                    name: "boss_code",
                    render: function(data, type, full, meta) {
                        return "<div class='w-full lg:w-2/5'>" +
                            "<img src='{{URL::to('/')}}/avatars/" + data + ".jpg' class='rounded-none lg:rounded-lg shadow-2xl hidden lg:block'>" +
                            "</div>";
                    },
                    orderable: false
                },
                {
                    data: "first_name",
                    name: "first_name"
                },
                {
                    data: "age",
                    name: "age"
                },
                {
                    data: "city",
                    name: "city"
                },
                {
                    data: "profession",
                    name: "profession"
                },
                {
                    data: "telephone",
                    name: "telephone"
                },
                {
                    data: "amount",
                    name: "amount"
                },
                {
                    data: "paiement",
                    name: "paiement"
                },
                {
                    data: "action",
                    name: "action"
                }
            ]
        });

        function userProfile(name,surname, img, state, amount, total_amount) {
            //modalMain.classList.toggle('hidden');
            document.getElementById('profile_modal').classList.toggle('hidden');
            document.getElementById('mainBody').classList.toggle('hidden');
            document.getElementById('profile_name').innerHTML = name;
            document.getElementById('profile_surname').innerHTML = surname;
            document.getElementById('profile_img').src = '{{URL::to("/")}}/avatars/' + img + '.jpg';
            if (state == 0) {
                document.getElementById('profile_invalide').classList.toggle('hidden');
                document.getElementById('profile_valide').classList.toggle('hidden');
            } else {
                document.getElementById('profile_invalide').classList.toggle('hidden');
                document.getElementById('profile_valide').classList.toggle('hidden');
            }

            document.getElementById('profile_current_amount').innerHTML = 'montant : ' + total_amount;
            document.getElementById('profile_amount').innerHTML = 'montant investi : ' + amount;
        }

        function preBoss(code) {
            var id = code.id;

            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/usersData/' + id,
                dataType: 'json',
                success: function(data) {
                    document.getElementById('content').innerHTML = '';
                    currency.innerHTML = 'Mes PreBoss';
                    if (data.user.length != 0) {
                        number.innerHTML = data.user.length;
                        console.log(data);
                        console.log(data.user);
                        var users = data.user;
                        modalMain.classList.toggle('hidden');
                        for (var i = 0; i < data.user.length; i++) {
                            var obj = data.user[i];
                            console.log(obj);

                            document.getElementById('content').innerHTML += '<div class="flex max-w-md mt-2 mb-2 bg-white shadow rounded-lg overflow-hidden" onclick="userProfile(\'' + obj.name + '\',\'' + obj.first_name + '\',\''+ obj.boss_code + '\',\'' + obj.confirm_account + '\',\'' + obj.amount + '\',\'' + obj.current_amount + '\')">' +
                                '<div class="w-2 main-color-bg"></div>' +
                                '<div class="flex items-center px-2 py-3">' +
                                '<img class="w-12 h-12 object-cover rounded-full" src="{{URL::to("/")}}/avatars/' + obj.boss_code + '.jpg">' +
                                '<div class="mx-3">' +
                                '<h2 class="text-xl font-semibold text-gray-800">' + obj.name + '</h2>' +
                                '<p class="text-gray-600"> ' + obj.first_name + ' a investi <text class="text-blue-500">' + obj.amount + '</text>.</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                    } else {
                        number.innerHTML = 0;
                        modalMain.classList.toggle('hidden');
                        document.getElementById('content').classList.add('main-color');
                        document.getElementById('content').classList.add('text-center');
                        document.getElementById('content').innerHTML += 'no PreBoss yet'
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function Mywallet(code) {
            var id = code;
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/walletData/' + id,
                dataType: 'json',
                success: function(data) {
                    document.getElementById('content').innerHTML = '';
                    currency.innerHTML = 'FCFA';
                    number.innerHTML = data.role[0].current_amount;
                    console.log(data.role);
                    //console.log(data.user);
                    if (data.user.length != 0) {
                        var users = data.user;
                        modalMain.classList.toggle('hidden');
                        for (var i = 0; i < data.user.length; i++) {
                            var obj = data.user[i];

                            document.getElementById('content').innerHTML += '<div class="flex max-w-md mt-2 mb-2  bg-white shadow rounded-lg overflow-hidden">' +
                                '<div class="w-2 main-color-bg"></div>' +
                                '<div class="flex items-center px-2 py-3">' +
                                '<img class="w-12 h-12 object-cover rounded-full" src="{{URL::to("/")}}/img/fdfsd.png">' +
                                '<div class="mx-3">' +
                                '<h2 class="text-xl font-semibold text-gray-800">' + obj.operation + '</h2>' +
                                '<p class="text-gray-600"> votre solde est  <text href="#" class="text-blue-500">' + obj.total_amount + '</text></p>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                    } else {
                        modalMain.classList.toggle('hidden');
                        document.getElementById('content').classList.add('main-color');
                        document.getElementById('content').classList.add('text-center');
                        document.getElementById('content').innerHTML += 'no Operation yet'
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function injectorBoss(code) {
            var id = code;
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/usersInjectData/' + id,
                dataType: 'json',
                success: function(data) {
                    document.getElementById('content').innerHTML = '';
                    currency.innerHTML = 'Mes InjectorBoss';
                    if (data.user != null) {
                        number.innerHTML = data.user.length;
                        console.log(data);
                        console.log(data.user);
                        var users = data.user;
                        modalMain.classList.toggle('hidden');
                        for (var i = 0; i < data.user.length; i++) {
                            var obj = data.user[i];

                            document.getElementById('content').innerHTML += '<div class="flex max-w-md mt-2 mb-2  bg-white shadow rounded-lg overflow-hidden" onclick="userProfile(\'' + obj.name + '\',\'' + obj.first_name + '\',\''+ obj.boss_code + '\',\'' + obj.confirm_account + '\',\'' + obj.amount + '\',\'' + obj.current_amount + '\')">' +
                                '<div class="w-2 main-color-bg"></div>' +
                                '<div class="flex items-center px-2 py-3">' +
                                '<img class="w-12 h-12 object-cover rounded-full" src="{{URL::to("/")}}/avatars/' + obj.boss_code + '.jpg">' +
                                '<div class="mx-3">' +
                                '<h2 class="text-xl font-semibold text-gray-800">' + obj.name + '</h2>' +
                                '<p class="text-gray-600"> ' + obj.first_name + ' a investi <text class="text-blue-500">' + obj.amount + '</text>.</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }
                    } else {
                        number.innerHTML = 0;
                        modalMain.classList.toggle('hidden');
                        document.getElementById('content').classList.add('main-color');
                        document.getElementById('content').classList.add('text-center');
                        document.getElementById('content').innerHTML += 'no Injector Boss yet'
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function advancedBoss(code) {
            var id = code.id;
            $.ajax({
                type: 'GET', //THIS NEEDS TO BE GET
                url: '/usersAdvData/' + id,
                dataType: 'json',
                success: function(data) {
                    document.getElementById('content').innerHTML = '';
                    currency.innerHTML = 'Mes Advanced Boss';
                    console.log(data)
                    if (data.user != null) {
                        number.innerHTML = data.user.length;
                        console.log(data.user);
                        var users = data.user;
                        modalMain.classList.toggle('hidden');
                        for (var i = 0; i < data.user.length; i++) {
                            var obj = data.user[i];
                            document.getElementById('content').innerHTML += '<div class="flex max-w-md mt-2 mb-2  bg-white shadow rounded-lg overflow-hidden" onclick="userProfile(\'' + obj.name + '\',\'' + obj.first_name + '\',\''+ obj.boss_code + '\',\'' + obj.confirm_account + '\',\'' + obj.amount + '\',\'' + obj.current_amount + '\')">' +
                                '<div class="w-2 main-color-bg"></div>' +
                                '<div class="flex items-center px-2 py-3">' +
                                '<img class="w-12 h-12 object-cover rounded-full" src="{{URL::to("/")}}/avatars/' + obj.boss_code + '.jpg">' +
                                '<div class="mx-3">' +
                                '<h2 class="text-xl font-semibold text-gray-800">' + obj.name + '</h2>' +
                                '<p class="text-gray-600"> ' + obj.first_name + ' a investi <text class="text-blue-500">' + obj.amount + '</text>.</p>' +
                                '</div>' +
                                '</div>' +
                                '</div>';
                        }

                    } else {
                        number.innerHTML = 0;
                        modalMain.classList.toggle('hidden');
                        document.getElementById('content').classList.add('main-color');
                        document.getElementById('content').classList.add('text-center');
                        document.getElementById('content').innerHTML += 'no Advanced Boss yet'
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }


        /* wallet.addEventListener('click', function () {
            modalMain.classList.toggle('hidden')
        }); */

        closeM.addEventListener('click', function() {
            console.log('toggle')
            modalMain.classList.toggle('hidden')
        });
        /* Refer to https://gionkunz.github.io/chartist-js/examples.html for setting up the graphs */

        var mainChart = new Chartist.Line('#chart1', {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            series: [
                [1, 5, 2, 5, 4, 3],
                [2, 3, 4, 8, 1, 2],
                [5, 4, 3, 2, 1, 0.5]
            ]
        }, {
            low: 0,
            showArea: true,
            showPoint: false,
            fullWidth: true
        });

        mainChart.on('draw', function(data) {
            if (data.type === 'line' || data.type === 'area') {
                data.element.animate({
                    d: {
                        begin: 1000 * data.index,
                        dur: 1000,
                        from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                        to: data.path.clone().stringify(),
                        easing: Chartist.Svg.Easing.easeOutQuint
                    }
                });
            }
        });



        function checkParent(t, elm) {
            while (t.parentNode) {
                if (t == elm) {
                    return true;
                }
                t = t.parentNode;
            }
            return false;
        }
        // Get all "navbar-burger" elements
        var $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

        // Check if there are any navbar burgers
        if ($navbarBurgers.length > 0) {

            // Add a click event on each of them
            $navbarBurgers.forEach(function($el) {
                $el.addEventListener('click', function() {

                    // Get the "main-nav" element
                    var $target = document.getElementById('main-nav');

                    // Toggle the class on "main-nav"
                    $target.classList.toggle('hidden');

                });
            });
        }

        $(document).on("click", ".update", function() {
            var edit_id = $(this).attr("id");
            var elt = $(this);
            console.log(edit_id);
            if (edit_id != '') {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: '/usersUpdate',
                    type: 'POST',
                    data: {
                        editid: edit_id
                    },
                    success: function(response) {
                        alert('compte confirmer');
                    }
                });
            } else {
                alert('id undefined');
            }
        });


        //var openmodal = document.querySelectorAll('.modal-open')

        $(document).on("click", ".modal-open", function() {
            var id = this.id;
            document.getElementById('hidden').value = id
            console.log('hum' + id)
            event.preventDefault()
            toggleModal()
        })

        $(document).on("click", "#submitDebit", function(e) {
            var id = document.getElementById('hidden').value;
            e.preventDefault();
            $.ajax({
                url: "/users/" + id + "/credit",
                method: "POST",
                data: new FormData(document.getElementById('formDebit')),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function() {
                    alert('transaction effectue');
                }
            })
        })
        var textD = document.getElementById('textD');
        var textC = document.getElementById('textC');
        var inputC = document.getElementById('inputC');
        var inputD = document.getElementById('inputD');
        var divD = document.getElementById('divD');
        var divC = document.getElementById('divC');
        toggle.onchange = function() {
            inputC.disabled = !this.checked;
            inputD.disabled = this.checked;
            if (this.checked) {
                divC.classList.remove('hidden');
                textC.classList.remove('hidden');
                divD.classList.add('hidden');
                textD.classList.add('hidden');
                inputC.focus();
            } else {
                divC.classList.add('hidden');
                textC.classList.add('hidden');
                divD.classList.remove('hidden');
                textD.classList.remove('hidden');
                inputD.focus();
            }
        }



        const overlay = document.querySelector('.modal-overlay')
        overlay.addEventListener('click', toggleModal)

        var closemodal = document.querySelectorAll('.modal-close')
        for (var i = 0; i < closemodal.length; i++) {
            closemodal[i].addEventListener('click', toggleModal)
        }

        document.onkeydown = function(evt) {
            evt = evt || window.event
            var isEscape = false
            if ("key" in evt) {
                isEscape = (evt.key === "Escape" || evt.key === "Esc")
            } else {
                isEscape = (evt.keyCode === 27)
            }
            if (isEscape && document.body.classList.contains('modal-active')) {
                toggleModal()
            }
        };


        function toggleModal() {
            const body = document.querySelector('body')
            const modal = document.querySelector('.modal')
            modal.classList.toggle('opacity-0')
            modal.classList.toggle('pointer-events-none')
            body.classList.toggle('modal-active')
        }

        var toggleInputContainer = function(input) {
            if (input.value != "") {
                input.classList.add('filled');
            } else {
                input.classList.remove('filled');
            }
        }

        var labels = document.querySelectorAll('.label');
        for (var i = 0; i < labels.length; i++) {
            labels[i].addEventListener('click', function() {
                this.previousElementSibling.focus();
            });
        }

        window.addEventListener("load", function() {
            var inputs = document.getElementsByClassName("input");
            for (var i = 0; i < inputs.length; i++) {
                console.log('looped');
                inputs[i].addEventListener('keyup', function() {
                    toggleInputContainer(this);
                });
                toggleInputContainer(inputs[i]);
            }
        });

        function app() {
            return {
                chartData: [112, 10, 225, 134, 101, 80, 50, 100, 200],
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],

                tooltipContent: '',
                tooltipOpen: false,
                tooltipX: 0,
                tooltipY: 0,
                showTooltip(e) {
                    console.log(e);
                    this.tooltipContent = e.target.textContent
                    this.tooltipX = e.target.offsetLeft - e.target.clientWidth;
                    this.tooltipY = e.target.clientHeight + e.target.clientWidth;
                },
                hideTooltip(e) {
                    this.tooltipContent = '';
                    this.tooltipOpen = false;
                    this.tooltipX = 0;
                    this.tooltipY = 0;
                }
            }
        }

        function notify() {
            var html = '<div id="notify" class="flex h-screen">' +
                '<div class="m-auto">' +
                '<div class="bg-white rounded-lg border-gray-300 border p-3 shadow-lg">' +
                '<div class="flex flex-row">' +
                '<div class="px-2">' +
                '<svg width="24" height="24" viewBox="0 0 1792 1792" fill="#44C997" xmlns="http://www.w3.org/2000/svg">' +
                '<path d="M1299 813l-422 422q-19 19-45 19t-45-19l-294-294q-19-19-19-45t19-45l102-102q19-19 45-19t45 19l147 147 275-275q19-19 45-19t45 19l102 102q19 19 19 45t-19 45zm141 83q0-148-73-273t-198-198-273-73-273 73-198 198-73 273 73 273 198 198 273 73 273-73 198-198 73-273zm224 0q0 209-103 385.5t-279.5 279.5-385.5 103-385.5-103-279.5-279.5-103-385.5 103-385.5 279.5-279.5 385.5-103 385.5 103 279.5 279.5 103 385.5z"/>' +
                '</svg>' +
                '</div>' +
                '<div class="ml-2 mr-6">' +
                '<span class="font-semibold">Success!</span>' +
                '<span class="block text-gray-500">Operation effectue avec succes</span>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            setTimeout(function() {

            }, 1000)
        }
    </script>
    <script src="{{asset('js/script.js')}}"></script>
</body>

</html>