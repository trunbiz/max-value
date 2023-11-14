@extends('publisher.base')
@section('title', 'FAQ')
@section('content')
    <h2 class="main-title mb-3">Frequently Asked Questions</h2>
    <div class="row g-5">
        <div class="col-xl">
            <p class="text-secondary mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

{{--            <div class="form-search py-2 mb-5">--}}
{{--                <i class="ri-search-line"></i>--}}
{{--                <input type="text" class="form-control" placeholder="Search">--}}
{{--            </div><!-- form-search -->--}}

            <div class="accordion accordion-faq" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What are tax summaries?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>Tax summaries provide a summary of the income earned during an income year and the taxes paid on your behalf. Tax summaries are provided for both US sourced and Australian sourced income.</p>
                            <p>There are 3 types of tax summaries:</p>
                            <ol>
                                <li>Form 1099 (US Citizens, or persons that do not provide details regarding tax residence);</li>
                                <li>Form 1042 (non-US Citizens); and</li>
                                <li>Australian withholding tax payment summaries.</li>
                            </ol>

                            <p>The IRS requires Envato to provide you with either a Form 1099 or a Form 1042 for income which is deemed to have a US source (subject to certain exceptions).</p>
                            <p>The Australian Tax Office similarly requires Envato to provide an Australian payment summary for Australian sourced income.</p>
                            <p class="mb-0">This information may be used when completing your tax return (and potentially claiming a credit for any taxes paid on your behalf), so make sure you give them to your tax advisor/accountant.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            How do I access my tax summary?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>Tax summaries are available electronically from your account settings, but we’ve made a slight change in how you access them to help protect your information.</p>
                            <p>Previously the ‘Tax Summaries’ option was available for everyone from the Author Tools menu in your account settings once you were logged in. Now, you will need to enable Two-Factor Authentication (2FA) before this option is visible, as well as update your preferences in ‘Tax Information’ - also available under Author Tools.</p>
                            <p><strong>Please follow these steps to view your tax summary</strong></p>
                            <ol>
                                <li>Once you’re logged into your account, go to your settings and under the “Author Tools” section on the left, click on Tax Information.</li>
                                <li>At the top of the Tax Information section you will be able to ‘opt in’ to view your online Tax Summary by ticking ‘Access Digital Tax Summaries’</li>
                            </ol>

                            <p class="mb-0"><i><strong>Please note:</strong> You can opt-out of having your tax summary available digitally at any time, as well as disabling 2FA, however, we don’t recommend this.</i></p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Why has tax been withheld from my earnings?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>Envato is required by law to withhold certain taxes from your earnings as an author. The relevant section of the author agreement says:</p>
                            <p><i>If required by law, we may deduct or withhold taxes (including withholding tax) in connection with your being an author. If so, we will give you relevant document that’s required by law about the deduction or withholding (like documentation allowing you to access rebates or credits, or to manage your tax affairs).</i></p>
                            <p>As an Australian company, Envato Elements Pty Ltd is required to withhold Australian Royalty Withholding Tax (AU RWT) from earnings paid out to authors located in other countries. The tax rate that applies can vary between 0% and 30%, depending on the tax treaty (if any) between Australia and your country.</p>
                            <p>We use the country information from your tax form (W8/W9) to calculate the amount to withhold. So please make sure you keep this information up to date if you move countries.</p>
                            <p class="mb-0">If taxes are withheld from your earnings, we will provide you with a relevant document each year to help you manage your tax affairs, for example, to claim a credit on your tax return for the amount withheld.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Why would a customer ask for my tax information?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>From time to time you may receive requests from customers requesting a certificate of residency from you.</p>
                            <p>There are a number of reasons why they might be doing this, a couple are:</p>
                            <ul>
                                <li>Some countries, such as Poland, require customers to submit certain tax information that includes information about where they have purchased from, and how much they paid.</li>
                                <li>Some companies, such as US companies, may have a code of business conduct that requires proper certification from you as to your tax residency status.</li>
                            </ul>
                            <p class="mb-0">Please note that if you do not provide your tax information to the customer, they may not be able to purchase your item.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            Do I need to pay taxes on my Envato Market earnings?
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>Any earnings that you receive from Envato Market are your responsibility to manage appropriately within your local country. We cannot provide advice on how you should proceed to pay taxes on your author earnings as tax laws vary greatly from country to country.</p>
                            <p>We encourage you to seek out professional advice on tax-law and filing taxes. While the specifics of your country’s tax laws might be different, there’s a good chance that your government still wants you to declare your income.</p>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            What happens to funds that are held by Envato?
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="accordion-body pt-0">
                            <p>It is Envato’s policy to suspend access to and prohibit the removal of funds from author accounts that Envato determines are related to individuals located in or associated with restricted countries. Funds held in suspended accounts will be held by Envato until the user is permitted to receive them. If you believe your account has been suspended in error, please <a href="">contact us</a> immediately.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- col -->
{{--        <div class="col-md-6 col-lg-7 col-xl-4 col-xxl-3">--}}
{{--            <h5 class="section-title mb-4">NPM Installation</h5>--}}

{{--            <nav class="nav nav-classic">--}}
{{--                <a href="" class="nav-link"><span>Common errors when intalling NPM</span></a>--}}
{{--                <a href="" class="nav-link"><span>NPM for Windows</span></a>--}}
{{--                <a href="" class="nav-link"><span>Cannot install npm in Mac</span></a>--}}
{{--                <a href="" class="nav-link"><span>NPM does not recognize in local</span></a>--}}
{{--                <a href="" class="nav-link"><span>NPM version not showing when doing command</span></a>--}}
{{--            </nav>--}}

{{--            <hr class="my-4 opacity-0">--}}

{{--            <h5 class="section-title mb-4">Bootstrap Installation</h5>--}}
{{--            <nav class="nav nav-classic">--}}
{{--                <a href="" class="nav-link"><span>Common errors when intalling Bootstrap</span></a>--}}
{{--                <a href="" class="nav-link"><span>Migrating from Bootstrap 4</span></a>--}}
{{--                <a href="" class="nav-link"><span>Bootstrap using Webpack</span></a>--}}
{{--                <a href="" class="nav-link"><span>Bootstrap react components</span></a>--}}
{{--                <a href="" class="nav-link"><span>Example of bootsrap page using navbar</span></a>--}}
{{--            </nav>--}}

{{--            <hr class="my-4 opacity-0">--}}

{{--            <h5 class="section-title mb-4">SASS Customization</h5>--}}
{{--            <nav class="nav nav-classic">--}}
{{--                <a href="" class="nav-link"><span>Minimize sass to css without bootstrap</span></a>--}}
{{--                <a href="" class="nav-link"><span>Adding more utilities classes in sass</span></a>--}}
{{--            </nav>--}}
{{--        </div><!-- col -->--}}
    </div><!-- row -->
@endsection
