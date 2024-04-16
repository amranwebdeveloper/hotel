{{-- GUNEY --}}
<div id="hotel-rooms" class="hotel_rooms_form" v-cloak="" :class="{'d-none':enquiry_type!='book'}">
    <div class="container ">
        <h3 class="heading-section">{{__('Available Rooms')}}</h3>
        <div class="nav-enquiry" v-if="is_form_enquiry_and_book">
            <div class="enquiry-item active" >
                <span>{{ __("Book") }}</span>
            </div>
            <div class="enquiry-item" data-toggle="modal" data-target="#enquiry_form_modal">
                <span>{{ __("Enquiry") }}</span>
            </div>
        </div>
    </div>
    <div class="form-book">
        <div class="container">
            <div class="form-search-rooms">
                <div class="d-flex form-search-row">
                    <div class="col-md-5 pr-md-1">
                        <div class="form-group form-date-field form-date-search " @click="openStartDate" data-format="{{get_moment_date_format()}}">
                            <i class="fa fa-angle-down arrow"></i>
                            <input type="text" class="start_date" ref="start_date" style="height: 1px; visibility: hidden">
                            <div class="date-wrapper form-content" >
                                <label class="form-label">{{__("Check In - Out")}}</label>
                                <div class="render check-in-render" v-html="start_date_html"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pl-md-1">
                        <div class="form-group">
                            <i class="fa fa-angle-down arrow"></i>
                            <div class="form-content dropdown-toggle" data-toggle="dropdown">
                                <label class="form-label">{{__('Guests')}}</label>
                                <div class="render">
                                    <span class="adults" >
                                        <span class="one" >@{{adults}}
                                            <span v-if="adults < 2">{{__('Adult')}}</span>
                                            <span v-else>{{__('Adults')}}</span>
                                        </span>
                                    </span>
                                    -
                                    <span class="children" >
                                        <span class="one" >@{{children}}
                                            <span v-if="children < 2">{{__('Child')}}</span>
                                            <span v-else>{{__('Children')}}</span>
                                        </span>
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown-menu select-guests-dropdown" >
                                <div class="dropdown-item-row">
                                    <div class="label">{{__('Adults')}}</div>
                                    <div class="val">
                                        <span class="btn-minus2" data-input="adults" @click="minusPersonType('adults')"><i class="icon ion-md-remove"></i></span>
                                        <span class="count-display"><input type="number" v-model="adults" min="1"/></span>
                                        <span class="btn-add2" data-input="adults" @click="addPersonType('adults')"><i class="icon ion-ios-add"></i></span>
                                    </div>
                                </div>
                                <div class="dropdown-item-row">
                                    <div class="row">
                                        <div class="label col-md-6">{{__('Children')}}</div>
                                        <div class="val col-md-6">
                                            <span class="btn-minus2 " data-input="children" @click="minusPersonType('children')"><i class="icon ion-md-remove"></i></span>
                                            <span class="count-display"><input type="number" v-model="children" min="0"/></span>
                                            <span class="btn-add2 " data-input="children" @click="addPersonType('children')"><i class="icon ion-ios-add"></i></span>
                                        </div>
                                            <div class="col-md-6 children_age" v-for="child_age in children_age">
                                                <select class="form-control" v-model="child_age.age">
                                                    <option value="">{{ __('Child Age') }}
                                                    </option>
                                                    <?php
                                                     for ($i=1; $i <17 ; $i++) {
                                                       echo "<option value='".$i."'>".$i."</option>";
                                                     }
                                                    ?>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                                {{-- Child age Start--}}

                                {{-- <div class="dropdown-item-row form-group-item">
                                    <div class="row">
                                        <div class="label col-md-6">{{__('Children')}}</div>
                                        <div class="val col-md-6">
                                            <span class="btn-minus2 btn-remove-item" data-input="children" @click="minusPersonType('children')"><i class="icon ion-md-remove"></i></span>
                                            <span class="count-display"><input type="number" v-model="children" min="0"/></span>
                                            <span class="btn-add2 btn-add-item" data-input="children" @click="addPersonType('children')"><i class="icon ion-ios-add"></i></span>
                                        </div>
                                        <div class="g-items row">
                                        </div>
                                        <div class="g-more hide">
                                            <div class="item col-md-6" data-number="__number__">
                                                <select class="form-control" v-model="children_age">
                                                    <option value="">{{ __('Child Age') }}
                                                    </option>
                                                    <?php
                                                     for ($i=1; $i <17 ; $i++) {
                                                       echo "<option value='".$i."'>".$i."</option>";
                                                     }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- Child age Start--}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-btn">
                        <div class="g-button-submit">
                            <button class="btn btn-primary btn-search" @click="checkAvailability" :class="{'loading':onLoadAvailability}" type="submit">
                                {{__("Update")}}
                                <i v-show="onLoadAvailability" class="fa fa-spinner fa-spin"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="start_room_sticky"></div>
        </div>
        <div class="hotel_list_rooms" :class="{'loading':onLoadAvailability}">
            <div class="container ">
                <div class="row">
                    <div class="col-md-12">
                        <div class="room-item" v-for="room in rooms">
                            <div class="row">
                                <div class="col-xs-12 col-md-3">
                                    <h5 class="room-name" @click="showGallery($event,room.id,room.gallery)">@{{room.title}}</h5>
                                    <div class="image" @click="showGallery($event,room.id,room.gallery)">
                                        <img :src="room.image" alt="">
                                        <div class="count-gallery" v-if="typeof room.gallery !='undefined' && room.gallery && room.gallery.length > 1">
                                            <i class="fa fa-picture-o"></i>
                                            @{{room.gallery.length}}
                                        </div>
                                    </div>
                                    <div class="modal" :id="'modal_room_'+room.id" tabindex="-1" role="dialog">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">@{{ room.title }}</h5>
                                                    <span class="c-pointer" data-dismiss="modal" aria-label="Close">
                                                        <i class="input-icon field-icon fa">
                                                            <img src="{{asset('images/ico_close.svg')}}" alt="close">
                                                        </i>
                                                    </span>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="fotorama" data-nav="thumbs" data-width="100%" data-auto="false" data-allowfullscreen="true">
                                                        <a v-for="g in room.gallery" :href="g.large"></a>
                                                    </div>
                                                    <div class="list-attributes">
                                                        <div class="attribute-item" v-for="term in room.terms">
                                                            <h4 class="title">@{{ term.parent.title }}</h4>
                                                            <ul v-if="term.child">
                                                                <li v-for="term_child in term.child">
                                                                    <i class="input-icon field-icon" v-bind:class="term_child.icon" data-toggle="tooltip" data-placement="top" :title="term_child.title"></i>
                                                                    @{{ term_child.title }}
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-9 room-detail-box ">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="room-attribute-item" v-if="room.term_features">
                                                <ul>
                                                    <li v-for="term_child in room.term_features">
                                                        <i class="input-icon field-icon" v-bind:class="term_child.icon" data-toggle="tooltip" data-placement="top" :title="term_child.title"></i> @{{ term_child.title }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="hotel-info">
                                                <ul class="room-meta">
                                                    <li v-if="room.size_html">
                                                        <div class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('Room Footage')}}">
                                                            <i class="input-icon field-icon icofont-ruler-compass-alt"></i> {{__('Room Footage')}}: <span v-html="room.size_html"></span>
                                                        </div>
                                                    </li>
                                                    <li v-if="room.beds_html">
                                                        <div class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('No. Beds')}}">
                                                            <i class="input-icon field-icon icofont-hotel"></i> {{__('No. Beds')}}: <span v-html="room.beds_html"></span>
                                                        </div>
                                                    </li>
                                                    <li v-if="room.adults_html">
                                                        <div class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('No. Adults')}}">
                                                            <i class="input-icon field-icon icofont-users-alt-4"></i> {{__('No. Adults')}}: <span v-html="room.adults_html"></span>
                                                        </div>
                                                    </li>
                                                    <li v-if="room.children_html">
                                                        <div class="item" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{__('No. Children')}}">
                                                            <i class="input-icon field-icon fa-child fa"></i> {{__('No. Children')}}: <span v-html="room.children_html"></span>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="col-price clear">
                                                <div class="text-center">
                                                    <span class="discount_price" v-html="room.discount_html"></span>
                                                    <span class="price" v-html="room.price_html"></span>
                                                </div>
                                                <select v-if="room.number" v-model="room.number_selected" class="custom-select">
                                                    <option value="0">0</option>
                                                    <option v-for="i in (1,room.number)" :value="i">@{{i+' '+ (i > 1 ? i18n.rooms  : i18n.room)}} &nbsp;&nbsp; (@{{formatMoney(i*room.price)}})</option>
                                                </select>
                                                <a class="" data-toggle="modal" :data-target="'#modal_room_availability_'+room.id">
                                                    <i class="icofont-ui-calendar"></i> {{__('Room Availability Calendar')}}
                                                </a>
                                                <div class="modal fade modal_room_availability" :id="'modal_room_availability_'+room.id" >
                                                    <div class="modal-dialog modal-dialog-centered modal-lg" >
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">@{{ room.title }}</h5>
                                                                <span class="c-pointer" data-dismiss="modal" aria-label="Close">
                                                                    <i class="input-icon field-icon fa">
                                                                        <img src="{{asset('images/ico_close.svg')}}" alt="close">
                                                                    </i>
                                                                </span>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="list-attributes">
                                                                    <div class="attribute-item" v-for="term in room.terms">
                                                                        <h4 class="title">@{{ term.parent.title }}</h4>
                                                                        @includeIf("Hotel::frontend.layouts.details.room-availability")
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="alert alert-danger" role="alert">
                                        {{__('You can only make reservations with our customer representative for the dates you have chosen in this facility. You can get more detailed information from')}} <a href="tel:{{setting_item("contact_phone")}}">{{setting_item("contact_phone")}}</a> .
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hotel_room_book_status" v-if="total_price">
            <div class="row row_extra_service" v-if="extra_price.length">
                <div class="col-md-12">
                    <div class="form-section-group">
                        <label>{{__('Extra prices:')}}</label>
                        <div class="row">
                            <div class="col-md-6 extra-item" v-for="(type,index) in extra_price">
                                <div class="extra-price-wrap d-flex justify-content-between">
                                    <div class="flex-grow-1">
                                        <label>
                                            <input type="checkbox" true-value="1" false-value="0" v-model="type.enable"> @{{type.name}}
                                            <div class="render" v-if="type.price_type">(@{{type.price_type}})</div>
                                        </label>
                                    </div>
                                    <div class="flex-shrink-0">@{{type.price_html}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row_total_price">
                <div class="col-md-6">
                    <div class="extra-price-wrap d-flex justify-content-between">
                        <div class="flex-grow-1">
                            <label>
                                {{__("Total Room")}}:
                            </label>
                        </div>
                        <div class="flex-shrink-0">
                            @{{total_rooms}}
                        </div>
                    </div>
                    <div class="extra-price-wrap d-flex justify-content-between" v-for="(type,index) in buyer_fees">
                        <div class="flex-grow-1">
                            <label>
                                @{{type.type_name}}
                                <span class="render" v-if="type.price_type">(@{{type.price_type}})</span>
                                <i class="icofont-info-circle" v-if="type.desc" data-toggle="tooltip" data-placement="top" :title="type.type_desc"></i>
                            </label>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="unit" v-if='type.unit == "percent"'>
                                @{{ type.price }}%
                            </div>
                            <div class="unit" v-else >
                                @{{ formatMoney(type.price) }}
                            </div>
                        </div>
                    </div>
                    <div class="extra-price-wrap d-flex justify-content-between " v-if="discount_price">
                        <div class="flex-grow-1">
                            <label>
                                {{__("Total discount")}}:
                            </label>
                        </div>
                        <div class="total-room-price">@{{total_discount_price_html}}</div>
                    </div>
                    <div class="extra-price-wrap d-flex justify-content-between is_mobile">
                        <div class="flex-grow-1">
                            <label>
                                {{__("Total Price")}}:
                            </label>
                        </div>
                        <div class="total-room-price">@{{total_price_html}}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="control-book">
                        <div class="total-room-price">
                            <span> {{__("Total Price")}}:</span> @{{total_price_html}}
                        </div>
                        <div v-if="is_deposit_ready" class="total-room-price">
                            <span>{{__("Pay now")}}</span>
                            @{{pay_now_price_html}}
                        </div>
                        <button type="button" class="btn btn-primary" @click="doSubmit($event)" :class="{'disabled':onSubmit}" name="submit">
                            <span >{{__("Book Now")}}</span>
                            <i v-show="onSubmit" class="fa fa-spinner fa-spin"></i>
                        </button>
                    </div>

                </div>
            </div>
        </div>
        <div class="end_room_sticky"></div>
        <div class="alert alert-warning" v-if="!firstLoad && !rooms.length">
            {{__("No room available with your selected date. Please change your search critical")}}
        </div>
    </div>
</div>
@include("Booking::frontend.global.enquiry-form",['service_type'=>'hotel'])
