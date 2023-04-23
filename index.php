<?php require_once('loader.php'); ?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RPG Item generator</title>

    <!-- Bootstrap core CSS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        .form-check-inline label {
            width: 150px;
        }
        #item_data td{
            padding: 5px;
        }
        #overlay {
            position: fixed; /* Sit on top of the page content */
            display: none; /* Hidden by default */
            width: 100%; /* Full width (cover the whole page) */
            height: 100%; /* Full height (cover the whole page) */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5); /* Black background with opacity */
            z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
            cursor: pointer; /* Add a pointer on hover */
        }

    </style>

</head>

<body class="bg-light">
<div id="overlay"></div>
<div class="d-flex justify-content-center">
  <div class="spinner-border" role="status">
    <span class="sr-only">Loading...</span>
  </div>
</div>
    <div class="container">
        <div class="py-5 text-center">
            <img class="d-block mx-auto mb-4" src="assets\images\raden.png" alt="" width="85" height="85">
            <h2>Adventures of Raden - Item Generator</h2>
            <p class="lead">This tool will generate items based on assets in database.</p>
        </div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="data_entry-tab" data-toggle="tab" href="#data-entry" role="tab"
                    aria-controls="data-entry" aria-selected="true">Data Entry</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#item-generation" role="tab"
                    aria-controls="item-generation" aria-selected="false">Item Generation</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="view-tab" data-toggle="tab" href="#item-view" role="tab"
                    aria-controls="item-view" aria-selected="false">Item View</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane active" id="data-entry" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row mt-2">
                    <div class="col-md-8 order-md-1">
                        <h4 class="mb-3">Image insert</h4>
                        <form enctype="multipart/form-data" class="needs-validation" action="action.php" method="POST"
                            novalidate>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Image insert -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label for="firstName">Image Upload</label>
                                            <input type="file" class="form-control col" id="fileToUpload"
                                                name="ig--fileToUpload" required>
                                        </div>
                                    </div>
                                    <!-- /Image insert -->
                                    <!-- Item Type -->
                                    <div class="row mb-3">
                                        <div class="col ">
                                            <label for="firstName">Item Type</label>
                                            <select class="form-control col" name="ig--type" id="img_type">
                                                <option it_type="armour" value="">Armour</option>
                                                <option it_type="armour" value="1"> - Plate</option>
                                                <option it_type="armour" value="2"> - Mail</option>
                                                <option it_type="armour" value="3"> - Leather</option>
                                                <option it_type="armour" value="4"> - Robes</option>
                                                <option it_type="shield" value="5"> - Shield</option>
                                                <option it_type="weapon" value="">Weapon</option>
                                                <option it_type="weapon" value="32"> - 1h Sword</option>
                                                <option it_type="weapon" value="33"> - 2h Sword</option>
                                                <option it_type="weapon" value="18"> - 1h Axe</option>
                                                <option it_type="weapon" value="19"> - 2h Axe</option>
                                                <option it_type="weapon" value="20"> - Bow</option>
                                                <option it_type="weapon" value="21"> - Crossbow</option>
                                                <option it_type="weapon" value="22"> - Dagger</option>
                                                <option it_type="weapon" value="23"> - Flail</option>
                                                <option it_type="weapon" value="24"> - Gun</option>
                                                <option it_type="weapon" value="25"> - 1h Mace</option>
                                                <option it_type="weapon" value="26"> - 2h Mace</option>
                                                <option it_type="weapon" value="27"> - Projectile</option>
                                                <option it_type="weapon" value="63"> - Melee</option>
                                                <option it_type="weapon" value="28"> - Scythe</option>
                                                <option it_type="weapon" value="29"> - Spear</option>
                                                <option it_type="weapon" value="30"> - Staff</option>
                                                <option it_type="weapon" value="31"> - Wand</option>
                                            </select>
                                            <select style="display:none;" class="form-control col mt-3"
                                                name="ig--type_sub" id="img_type_sub">
                                                <option it_type="armour" value="6">Head</option>
                                                <option it_type="armour" value="7">Body</option>
                                                <option it_type="armour" value="8">Accessory</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- /Item Type -->
                                    <!-- Item Elements -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="w-100">Element</label>
                                            <div class="form-check form-check-inline">
                                                <!-- Fire -->
                                                <input id="check_fire" class="form-check-input" name="ig--fire"
                                                    type="checkbox" value="34">
                                                <label class="form-check-label mr-2" for="check_fire">Fire</label>
                                                <!-- /Fire -->
                                                <!-- Ice -->
                                                <input id="check_ice" class="form-check-input" name="ig--ice"
                                                    type="checkbox" value="35">
                                                <label class="form-check-label mr-2" for="check_ice">Ice</label>
                                                <!-- /Ice -->
                                                <!-- Thunder -->
                                                <input id="check_thunder" class="form-check-input" name="ig--thunder"
                                                    type="checkbox" value="36">
                                                <label class="form-check-label mr-2" for="check_thunder">Thunder</label>
                                                <!-- /Thunder -->
                                                <!-- Water -->
                                                <input id="check_water" class="form-check-input" name="ig--water"
                                                    type="checkbox" value="37">
                                                <label class="form-check-label mr-2" for="check_water">Water</label>
                                                <!-- /Water -->
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <!-- Earth -->
                                                <input id="check_earth" class="form-check-input" name="ig--earth"
                                                    type="checkbox" value="38">
                                                <label class="form-check-label mr-2" for="check_earth">Earth</label>
                                                <!-- /Earth -->
                                                <!-- Wind -->
                                                <input id="check_wind" class="form-check-input" name="ig--wind"
                                                    type="checkbox" value="39">
                                                <label class="form-check-label mr-2" for="check_wind">Wind</label>
                                                <!-- /Wind -->
                                                <!-- Light -->
                                                <input id="check_light" class="form-check-input" name="ig--light"
                                                    type="checkbox" value="40">
                                                <label class="form-check-label mr-2" for="check_light">Light</label>
                                                <!-- /Light -->
                                                <!-- Darkness -->
                                                <input id="check_darkness" class="form-check-input" name="ig--darkness"
                                                    type="checkbox" value="41">
                                                <label class="form-check-label mr-2"
                                                    for="check_darkness">Darkness</label>
                                                <!-- /Darkness -->
                                                <!-- Burst -->
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="check_burst" class="form-check-input" name="ig--burst"
                                                    type="checkbox" value="71">
                                                <label class="form-check-label mr-2" for="check_burst">Burst</label>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- /Item Elements -->
                                    <!-- Item States -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="w-100">State</label>
                                            <div class="form-check form-check-inline">
                                                <!-- Death -->
                                                <input id="check_death" class="form-check-input" name="ig--death"
                                                    type="checkbox" value="42">
                                                <label class="form-check-label mr-2" for="check_death">Death</label>
                                                <!-- /Death -->
                                                <!-- Stun -->
                                                <input id="check_stun" class="form-check-input" name="ig--stun"
                                                    type="checkbox" value="43">
                                                <label class="form-check-label mr-2" for="check_stun">Stun</label>
                                                <!-- /Stun -->
                                                <!-- Poison -->
                                                <input id="check_poison" class="form-check-input" name="ig--poison"
                                                    type="checkbox" value="44">
                                                <label class="form-check-label mr-2" for="check_poison">Poison</label>
                                                <!-- /Poison -->
                                                <!-- Blind -->
                                                <input id="check_blind" class="form-check-input" name="ig--blind"
                                                    type="checkbox" value="45">
                                                <label class="form-check-label mr-2" for="check_blind">Blind</label>
                                                <!-- /Blind -->
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <!-- Silence -->
                                                <input id="check_silence" class="form-check-input" name="ig--silence"
                                                    type="checkbox" value="46">
                                                <label class="form-check-label mr-2" for="check_silence">Silence</label>
                                                <!-- /Silence -->
                                                <!-- Confused -->
                                                <input id="check_confused" class="form-check-input" name="ig--confused"
                                                    type="checkbox" value="47">
                                                <label class="form-check-label mr-2"
                                                    for="check_confused">Confused</label>
                                                <!-- /Confused -->
                                                <!-- Sleep -->
                                                <input id="check_sleep" class="form-check-input" name="ig--sleep"
                                                    type="checkbox" value="48">
                                                <label class="form-check-label mr-2" for="check_sleep">Sleep</label>
                                                <!-- /Sleep -->
                                                <!-- Weak -->
                                                <input id="check_weak" class="form-check-input" name="ig--weak"
                                                    type="checkbox" value="49">
                                                <label class="form-check-label mr-2" for="check_weak">Weak (-
                                                    Str)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="check_steriod" class="form-check-input" name="ig--steriod"
                                                    type="checkbox" value="64">
                                                <label class="form-check-label mr-2" for="check_steriod">Steriod (+
                                                    Str)</label>
                                                <!-- /Weak -->
                                                <!-- Clumsy -->
                                                <input id="check_clumsy" class="form-check-input" name="ig--clumsy"
                                                    type="checkbox" value="50">
                                                <label class="form-check-label mr-2" for="check_clumsy">Clumsy (-
                                                    Dex)</label>
                                                <input id="check_finesse" class="form-check-input" name="ig--finesse"
                                                    type="checkbox" value="65">
                                                <label class="form-check-label mr-2" for="check_finesse">Finesse (+
                                                    Dex)</label>
                                                <!-- /Clumsy -->
                                                <!-- Delayed -->
                                                <input id="check_delayed" class="form-check-input" name="ig--delayed"
                                                    type="checkbox" value="51">
                                                <label class="form-check-label mr-2" for="check_delayed">Delayed (-
                                                    Agi)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="check_swiftness" class="form-check-input"
                                                    name="ig--swiftness" type="checkbox" value="66">
                                                <label class="form-check-label mr-2" for="check_swiftness">Swiftness (+
                                                    Agi)</label>
                                                <!-- /Delayed -->
                                                <!-- Enfeebled -->
                                                <input id="check_enfeebled" class="form-check-input"
                                                    name="ig--enfeebled" type="checkbox" value="52">
                                                <label class="form-check-label mr-2" for="check_enfeebled">Enfeebled (-
                                                    int)</label>
                                                <input id="check_focus" class="form-check-input" name="ig--focus"
                                                    type="checkbox" value="67">
                                                <label class="form-check-label mr-2" for="check_focus">Focus (+
                                                    int)</label>
                                                <!-- /Enfeebled -->
                                                <!-- Sharpen -->
                                                <input id="check_sharpen" class="form-check-input" name="ig--sharpen"
                                                    type="checkbox" value="53">
                                                <label class="form-check-label mr-2" for="check_sharpen">Sharpen (+
                                                    atk)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="check_blunt" class="form-check-input" name="ig--finesse"
                                                    type="checkbox" value="68">
                                                <label class="form-check-label mr-2" for="check_blunt">Blunt (-
                                                    atk)</label>
                                                <!-- /Sharpen -->
                                                <!-- Barrier -->
                                                <input id="check_barrier" class="form-check-input" name="ig--barrier"
                                                    type="checkbox" value="54">
                                                <label class="form-check-label mr-2" for="check_barrier">Barrier (+
                                                    pdef)</label>
                                                <input id="check_sunder" class="form-check-input" name="ig--sunder"
                                                    type="checkbox" value="69">
                                                <label class="form-check-label mr-2" for="check_sunder">Sunder (-
                                                    pdef)</label>
                                                <!-- /Barrier -->
                                                <!-- Resist -->
                                                <input id="check_resist" class="form-check-input" name="ig--resist"
                                                    type="checkbox" value="55">
                                                <label class="form-check-label mr-2" for="check_resist">Resist (+
                                                    mdef)</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input id="check_succumb" class="form-check-input" name="ig--resist"
                                                    type="checkbox" value="70">
                                                <label class="form-check-label mr-2" for="check_succumb">Succumb (-
                                                    mdef)</label>
                                                <!-- /Resist -->
                                                <!-- Blink -->
                                                <input id="check_blink" class="form-check-input" name="ig--blink"
                                                    type="checkbox" value="56">
                                                <label class="form-check-label mr-2" for="check_blink">Blink (+
                                                    eva)</label>
                                                <!-- /Blink -->
                                                <!-- Tired -->
                                                <input id="check_tired" class="form-check-input" name="ig--tired"
                                                    type="checkbox" value="57">
                                                <label class="form-check-label mr-2" for="check_tired">Tired (can't
                                                    move)</label>
                                                <!-- /Tired -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Item States -->
                                    <!-- Item Rarity -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="w-100">Rarity</label>
                                            <div class="form-check form-check-inline">
                                                <!-- Here George -->
                                                 <!-- Broken -->
                                                <input id="check_broken" class="form-check-input" name="ig--broken"
                                                    type="checkbox" value="58">
                                                <label class="form-check-label mr-2" for="check_broken">Broken</label>
                                                <!-- /Broken -->
                                                 <!-- Common -->
                                                <input id="check_common" class="form-check-input" name="ig--common"
                                                    type="checkbox" value="59">
                                                <label class="form-check-label mr-2" for="check_common">Common</label>
                                                <!-- /Common -->
                                                 <!-- Uncommon -->
                                                <input id="check_uncommon" class="form-check-input" name="ig--uncommon"
                                                    type="checkbox" value="60">
                                                <label class="form-check-label mr-2" for="check_uncommon">Uncommon</label>
                                                <!-- /Uncommon -->
                                                <!-- Rare -->
                                                <input id="check_rare" class="form-check-input" name="ig--rare"
                                                    type="checkbox" value="61">
                                                <label class="form-check-label mr-2" for="check_rare">Rare</label>
                                                <!-- /Rare -->
                                                <!-- Epic -->
                                                <input id="check_epic" class="form-check-input" name="ig--epic"
                                                    type="checkbox" value="62">
                                                <label class="form-check-label mr-2" for="check_epic">Epic</label>
                                                <!-- /Epic -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Item Rarity -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <button type="submit" name="submit"
                                                class="btn btn-primary mb-2">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="item-generation" role="tabpanel" aria-labelledby="data-entry">
                <div class="row mt-2">
                    <div class="col-md-9 order-md-1">
                        <h4 class="mb-3">Item parameters</h4>
                        <form class="needs-validation" action="action.php" method="POST" novalidate>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="firstName">Item Name</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control col" id="gen--name"
                                                placeholder="The Master Sword" >
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 ">
                                    <label for="firstName">Item Type</label>
                                    <select class="form-control col" name="gen--type" id="img_type2">
                                        <option it_type="armour" value="1"> - Plate</option>
                                        <option it_type="armour" value="2"> - Mail</option>
                                        <option it_type="armour" value="3"> - Leather</option>
                                        <option it_type="armour" value="4"> - Robes</option>
                                        <option it_type="shield" value="5"> - Shield</option>
                                        <option it_type="weapon" value="">Weapon</option>
                                        <option it_type="weapon" value="32" selected > - 1h Sword</option>
                                        <option it_type="weapon" value="33"> - 2h Sword</option>
                                        <option it_type="weapon" value="18"> - 1h Axe</option>
                                        <option it_type="weapon" value="19"> - 2h Axe</option>
                                        <option it_type="weapon" value="20"> - Bow</option>
                                        <option it_type="weapon" value="21"> - Crossbow</option>
                                        <option it_type="weapon" value="22"> - Dagger</option>
                                        <option it_type="weapon" value="23"> - Flail</option>
                                        <option it_type="weapon" value="24"> - Gun</option>
                                        <option it_type="weapon" value="25"> - 1h Mace</option>
                                        <option it_type="weapon" value="26"> - 2h Mace</option>
                                        <option it_type="weapon" value="27"> - Projectile</option>
                                        <option it_type="weapon" value="63"> - Melee</option>
                                        <option it_type="weapon" value="28"> - Scythe</option>
                                        <option it_type="weapon" value="29"> - Spear</option>
                                        <option it_type="weapon" value="30"> - Staff</option>
                                        <option it_type="weapon" value="31"> - Wand</option>
                                    </select>
                                    <select style="display:none;" class="form-control col mt-3" name="gen--type_sub"
                                        id="img_type_sub2">
                                        <option it_type="armour" value=""></option>
                                        <option it_type="armour" value="6">Head</option>
                                        <option it_type="armour" value="7">Body</option>
                                        <option it_type="armour" value="8">Accessory</option>
                                    </select>
                                    <!-- /Item Type -->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Level</label>
                                    <div class="row">
                                        <div class="col">
                                            <input type="number" value="10" class="form-control" id="gen--level" placeholder="Level"
                                                required>
                                        </div>
                                    </div>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                            </div>
                            <!-- Item Elements -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="w-100">Element</label>
                                    <div class="form-check form-check-inline">
                                        <!-- Fire -->
                                        <input id="gen--fire" class="form-check-input gen_box" name="gen--fire" type="checkbox"
                                            value="34">
                                        <label class="form-check-label mr-2" for="gen--fire">Fire</label>
                                        <!-- /Fire -->
                                        <!-- Ice -->
                                        <input id="gen--ice" class="form-check-input gen_box" name="gen--ice" type="checkbox"
                                            value="35">
                                        <label class="form-check-label mr-2" for="gen--ice">Ice</label>
                                        <!-- /Ice -->
                                        <!-- Thunder -->
                                        <input id="gen--thunder" class="form-check-input gen_box" name="gen--thunder"
                                            type="checkbox" value="36">
                                        <label class="form-check-label mr-2" for="gen--thunder">Thunder</label>
                                        <!-- /Thunder -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <!-- Water -->
                                        <input id="gen--water" class="form-check-input gen_box" name="gen--water"
                                            type="checkbox" value="37">
                                        <label class="form-check-label mr-2" for="gen--water">Water</label>
                                        <!-- /Water -->
                                        <!-- Earth -->
                                        <input id="gen--earth" class="form-check-input gen_box" name="gen--earth"
                                            type="checkbox" value="38">
                                        <label class="form-check-label mr-2" for="gen--earth">Earth</label>
                                        <!-- /Earth -->
                                        <!-- Wind -->
                                        <input id="gen--wind" class="form-check-input gen_box" name="gen--wind" type="checkbox"
                                            value="39">
                                        <label class="form-check-label mr-2" for="gen--wind">Wind</label>
                                        <!-- /Wind -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <!-- Light -->
                                        <input id="gen--light" class="form-check-input gen_box" name="gen--light"
                                            type="checkbox" value="40">
                                        <label class="form-check-label mr-2" for="gen--light">Light</label>
                                        <!-- /Light -->
                                        <!-- Darkness -->
                                        <input id="gen--darkness" class="form-check-input gen_box" name="gen--darkness"
                                            type="checkbox" value="41">
                                        <label class="form-check-label mr-2" for="gen--darkness">Darkness</label>
                                        <!-- /Darkness -->
                                        <!-- Burst -->
                                        <input id="gen--burst" class="form-check-input gen_box" name="gen--burst"
                                            type="checkbox" value="71">
                                        <label class="form-check-label mr-2" for="gen--burst">Burst</label>
                                    </div>
                                </div>
                            </div>
                            <!-- /Item Elements -->
                            <!-- Item States -->
                            <div class="row mb-3">
                                <div class="col">
                                    <label class="w-100">State</label>
                                    <div class="form-check form-check-inline">
                                        <!-- Death -->
                                        <input id="gen--death" class="form-check-input gen_box" name="gen--death"
                                            type="checkbox" value="42">
                                        <label class="form-check-label mr-2" for="gen--death">Death</label>
                                        <!-- /Death -->
                                        <!-- Stun -->
                                        <input id="gen--stun" class="form-check-input gen_box" name="gen--stun" type="checkbox"
                                            value="43">
                                        <label class="form-check-label mr-2" for="gen--stun">Stun</label>
                                        <!-- /Stun -->
                                        <!-- Poison -->
                                        <input id="gen--poison" class="form-check-input gen_box" name="gen--poison"
                                            type="checkbox" value="44">
                                        <label class="form-check-label mr-2" for="gen--poison">Poison</label>
                                        <!-- /Poison -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <!-- Blind -->
                                        <input id="gen--blind" class="form-check-input gen_box" name="gen--blind"
                                            type="checkbox" value="45">
                                        <label class="form-check-label mr-2" for="gen--blind">Blind</label>
                                        <!-- /Blind -->
                                        <!-- Silence -->
                                        <input id="gen--silence" class="form-check-input gen_box" name="gen--silence"
                                            type="checkbox" value="46">
                                        <label class="form-check-label mr-2" for="gen--silence">Silence</label>
                                        <!-- /Silence -->
                                        <!-- Confused -->
                                        <input id="gen--confused" class="form-check-input gen_box" name="gen--confused"
                                            type="checkbox" value="47">
                                        <label class="form-check-label mr-2" for="gen--confused">Confused</label>
                                        <!-- /Confused -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <!-- Sleep -->
                                        <input id="gen--sleep" class="form-check-input gen_box" name="gen--sleep"
                                            type="checkbox" value="48">
                                        <label class="form-check-label mr-2" for="gen--sleep">Sleep</label>
                                        <!-- /Sleep -->
                                        <!-- Weak -->
                                        <input id="gen--weak" class="form-check-input gen_box" name="gen--weak" type="checkbox"
                                            value="49">
                                        <label class="form-check-label mr-2" for="gen--weak">Weak (- Str)</label>
                                        <!-- /Weak -->
                                        <!-- Steriod -->
                                        <input id="gen--steriod" class="form-check-input gen_box" name="gen--steriod"
                                            type="checkbox" value="64">
                                        <label class="form-check-label mr-2" for="gen--steriod">Steriod (+ Str)</label>
                                        <!-- /Steriod -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <!-- Clumsy -->
                                        <input id="gen--clumsy" class="form-check-input gen_box" name="gen--clumsy"
                                            type="checkbox" value="50">
                                        <label class="form-check-label mr-2" for="gen--clumsy">Clumsy (- Dex)</label>
                                        <!-- /Clumsy -->
                                        <!-- Finesse -->
                                        <input id="gen--finesse" class="form-check-input gen_box" name="gen--finesse"
                                            type="checkbox" value="65">
                                        <label class="form-check-label mr-2" for="gen--finesse">Finesse (+ Dex)</label>
                                        <!-- /Finesse -->
                                        <!-- Delayed -->
                                        <input id="gen--delayed" class="form-check-input gen_box" name="gen--delayed"
                                            type="checkbox" value="51">
                                        <label class="form-check-label mr-2" for="gen--delayed">Delayed (- Agi)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="gen--swiftness" class="form-check-input gen_box" name="gen--swiftness"
                                            type="checkbox" value="66">
                                        <label class="form-check-label mr-2" for="gen--swiftness">Swiftness (+
                                            Agi)</label>
                                        <!-- /Delayed -->
                                        <!-- Enfeebled -->
                                        <input id="gen--enfeebled" class="form-check-input gen_box" name="gen--enfeebled"
                                            type="checkbox" value="52">
                                        <label class="form-check-label mr-2" for="gen--enfeebled">Enfeebled (-
                                            int)</label>
                                        <!-- /Enfeebled -->
                                        <!-- Focus -->
                                        <input id="gen--focus" class="form-check-input gen_box" name="gen--focus"
                                            type="checkbox" value="67">
                                        <label class="form-check-label mr-2" for="gen--focus">Focus (+ int)</label>
                                        <!-- /Focus -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <!-- Sharpen -->
                                        <input id="gen--sharpen" class="form-check-input gen_box" name="gen--sharpen"
                                            type="checkbox" value="53">
                                        <label class="form-check-label mr-2" for="gen--sharpen">Sharpen (+ atk)</label>
                                        <!-- /Sharpen -->
                                        <!-- Blunt -->
                                        <input id="gen--blunt" class="form-check-input gen_box" name="gen--blunt"
                                            type="checkbox" value="68">
                                        <label class="form-check-label mr-2" for="gen--blunt">Blunt (- atk)</label>
                                        <!-- /Blunt -->
                                        <!-- Barrier -->
                                        <input id="gen--barrier" class="form-check-input gen_box" name="gen--barrier"
                                            type="checkbox" value="54">
                                        <label class="form-check-label mr-2" for="gen--barrier">Barrier (+
                                            pdef)</label>
                                        <!-- /Barrier -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="gen--sunder" class="form-check-input gen_box" name="gen--sunder"
                                            type="checkbox" value="69">
                                        <label class="form-check-label mr-2" for="gen--sunder">Sunder (- pdef)</label>
                                        <!-- Resist -->
                                        <input id="gen--resist" class="form-check-input gen_box" name="gen--resist"
                                            type="checkbox" value="55">
                                        <label class="form-check-label mr-2" for="gen--resist">Resist (+ mdef)</label>

                                        <input id="gen--succumb" class="form-check-input gen_box" name="gen--resist"
                                            type="checkbox" value="70">
                                        <label class="form-check-label mr-2" for="gen--succumb">Succumb (-
                                            mdef)</label>
                                        <!-- /Resist -->
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <!-- Blink -->
                                        <input id="gen--blink" class="form-check-input gen_box" name="gen--blink"
                                            type="checkbox" value="56">
                                        <label class="form-check-label mr-2" for="gen--blink">Blink (+ eva)</label>
                                        <!-- /Blink -->
                                        <!-- Tired -->
                                        <input id="gen--tired" class="form-check-input gen_box" name="gen--tired"
                                            type="checkbox" value="57">
                                        <label class="form-check-label mr-2" for="gen--tired">Tired (can't
                                            move)</label>
                                        <!-- /Tired -->
                                    </div>
                                    <!-- Item Rarity -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <label class="w-100">Rarity</label>
                                            <div class="form-check form-check-inline">
                                                <select class="form-control col" name="gen--rarity" id="gen--rarity">
                                                    <option it_type="armour" value="58">Broken</option>
                                                    <option it_type="armour" value="59" selected>Common</option>
                                                    <option it_type="armour" value="60">Uncommon</option>
                                                    <option it_type="armour" value="61">Rare</option>
                                                    <option it_type="armour" value="62">Epic</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Item Rarity -->
                                    <div class="row mb-3">
                                        <div class="col">
                                            <button type="submit" name="submit" id="gen--submit"
                                                value="gen" class="btn btn-primary mb-2">Generate Item</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-3 order-md-2 mb-4">
                                <h4 class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="text-muted">Your generated item.</span>
                                </h4>
                                <ul class="list-group mb-3">
                                    <li class="list-group-item d-flex justify-content-between flex-wrap lh-condensed">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1 ">Weapon Name</h6>
                                            <img width="24px" height="24px" id="fin-item_img">

                                        </div>
                                        <p id="fin-item_name" class="mb-1"></p>
                                        <hr class="w-100"/>
                                        <h6 class="mb-1 w-100">Elements</h6>
                                        <div id="fin-elements"></div>
                                        <hr class="w-100"/>
                                        <h6 class="mb-1 w-100">States</h6>
                                        <div id="fin-states"></div>
                                        <hr class="w-100"/>
                                        <h6 class="mb-1 w-100">Stats</h6>
                                        <div id="fin-stats" class="w-100"></div>
                                        <hr class="w-100"/>
                                        <h6 class="mb-1 w-100">Attack</h6>
                                        <div id="fin-atkdef" class="w-100"></div>
                                    </li>

                                </ul>
                            </div>
                    </div>
            </div>
            <div class="tab-pane fade" id="item-view" role="tabpanel" aria-labelledby="item-view">
                <div class="row mb-3 mt-3">
                    <div class="col">
                        <button id="view_load" type="button"
                            value="load" class="btn btn-primary btn-block">Load</button>
                        <table id="item_data"></table>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">

        </footer>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict';

            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');

                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

    </script>
    <script src="assets/js/data-entry.js"></script>
    <script src="assets/js/generation-handler.js"></script>
    <script src="assets/js/data-load.js"></script>
</body>

</html>
