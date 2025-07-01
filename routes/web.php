<?php

use App\Http\Controllers\AboutController;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Middleware\isAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartItemController;

use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WishlistItemController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
  Route::resource('product', ProductController::class)->middleware(isAdmin::class);

  // Products in home page
  Route::get('/api/product', function(){

    
    
  });
  // Related products in detail products
  Route::get('/api/product/related', function(){
    $categories = request()->categories;
    $productId = request()->productId;
    $products = Product::wherehas('categories', function($query) use ($categories) {
      $query->whereIn('id', $categories);
    })->where('id', '!=', $productId)->inRandomOrder()->limit(8)->get();
    return $products;
  });

  Route::get('/asaa/{as}')->name('category.show');

  Route::get('/about/{content?}', function($content = null) {
    if(!isset($content) || !in_array(strtolower($content), ['about','faqs', 'terms-condition', 'privacy', 'contact-us'])){
      return view('components.about.about');
    }else if(strtolower($content) == 'faqs'){
      $faqs = [
          // 1. General Questions about Ordering
          "How do I place an order on this website?" => "To place an order, kindly navigate through our product catalog. Once you have identified the desired item, select it to view detailed product information, and then click the 'Add to Cart' button. You may continue shopping or proceed directly to your shopping cart. In the cart, you can review your selections, choose your preferred shipping method, and proceed to payment. Please follow the on-screen instructions until your order is successfully confirmed. Creating an account is recommended for convenient order tracking.",

          "Can I modify or cancel an order after it has been confirmed?" => "Once an order has been confirmed and processed, modifications or cancellations directly through the system become challenging. We advise contacting our customer service team immediately via telephone or live chat. If the order has not yet been dispatched, we may be able to assist. However, if the order is already in transit, kindly await its delivery and then initiate a return process in accordance with our return policy.",

          "How can I track the status of my order?" => "You may conveniently track your order status by logging into your account and visiting the 'Order History' or 'My Orders' section. Real-time updates regarding your order will be displayed there. Upon dispatch, a shipping tracking number will typically be provided, enabling direct tracking on the courier's website. Significant order updates will also be communicated via email notifications.",

          "What is a pre-order and how do I place one?" => "A pre-order allows you to reserve products that are not yet officially released or are in limited stock. This secures your opportunity to be among the first to receive the item. The ordering process for pre-order items is identical to that of regular products; simply click 'Pre-order' on the product page and complete the payment. We will then provide an estimated shipping date for your pre-ordered product. Please ensure you review the product details thoroughly before placing a pre-order.",

          // 2. Payment
          "What payment methods are accepted?" => "We offer a diverse range of payment options for your convenience. You may complete your payment via bank transfer (e.g., BCA, Mandiri), major credit/debit cards (Visa, Mastercard), various e-wallets (e.g., OVO, GoPay, Dana, LinkAja), or virtual bank accounts. Kindly select your preferred method during the checkout process.",

          "Is my payment secure on this website?" => "Your payment security is of utmost importance to us. We employ advanced SSL encryption to safeguard all transactions and personal data. This ensures that your credit card information and bank details are encrypted and inaccessible to unauthorized third parties. Your privacy and data security are our highest priority.",

          "Why did my payment fail?" => "Payment failures can occur due to several reasons, such as insufficient card limits, technical issues with your bank, or incorrect data entry (e.g., card number, CVV). Please verify all entered details, or consider using an alternative payment method. Should the issue persist, we recommend contacting your bank or our customer service team for further assistance.",

          "Can I pay in installments?" => "Installment payment options may be available for specific products or through certain payment methods, particularly with credit cards from our partnered banks. These options will be presented to you during the checkout process if applicable.",

          // 3. Shipping & Delivery
          "How long will it take for my order to be delivered?" => "Delivery times vary depending on your geographical location and the selected shipping service. Orders are typically processed within 1-2 business days following payment verification. For standard shipping, the estimated delivery timeframe is 2-7 business days. Expedited shipping options are available for faster delivery. A more precise estimated delivery time will be provided when you select your courier during checkout.",

          "How much does shipping cost?" => "Shipping costs are calculated based on the product's weight, the delivery destination, and the chosen courier service. The total shipping cost will be displayed on the shopping cart page prior to checkout for full transparency.",

          "Can I change my shipping address after the order has been processed?" => "Once an order has been processed or dispatched, changes to the shipping address are generally not possible. We strongly advise reviewing your shipping address carefully before completing your order. In urgent circumstances, please contact our customer service team immediately, and we will endeavor to assist.",

          "What should I do if my package is lost or damaged during shipping?" => "In the unfortunate event that your package is lost or sustains damage during transit, please contact our customer service team promptly with your order details. We will assist in investigating the issue with the courier service and determine the most appropriate resolution, which may include a re-shipment or a refund, depending on the specific circumstances. Timely notification is crucial.",

          "Can I pick up my order directly?" => "Currently, we do not offer direct pick-up options at our warehouse or physical store locations. All orders are dispatched via courier services to your specified address.",

          // 4. Returns & Exchanges
          "What is your return and exchange policy?" => "We maintain a clear return and exchange policy. You may initiate a return or exchange request within X days (e.g., 7 days) of receiving the product, provided the item remains in its original, unused condition with all original labels and packaging intact. Certain products may be subject to specific return conditions (e.g., final sale items). Comprehensive details are available on our 'Return Policy' page.",

          "How do I initiate a return or exchange?" => "To initiate a return or exchange, please log into your account and navigate to 'Order History'. Select the relevant order and click the 'Request Return/Exchange' button (if available). Kindly follow the provided instructions. Our team will review your submission. If you do not have an account, please contact our customer service directly for assistance.",

          "How long does the refund process take?" => "The refund process typically takes approximately X-Y business days (e.g., 5-10 business days) after the returned product has been received and its condition verified by our team. This timeframe may vary depending on your original payment method and the policies of your bank or payment provider. We will notify you via email once the refund process commences.",

          "Do I have to pay for return shipping?" => "Generally, the cost of return shipping is the responsibility of the buyer. However, if the product received is damaged or incorrect due to an error on our part, we will cover the return shipping expenses.",

          // 5. Account & Technical Issues
          "How do I create an account on this website?" => "To create an account, please click the 'Sign Up' or 'Create Account' button located in the top right corner of the page. Kindly fill in your required details (name, email, password) and then click 'Register'. The process is straightforward.",

          "I forgot my password, how do I reset it?" => "Should you forget your password, please click 'Forgot Password?' on the login page. An email containing instructions to set a new password will then be sent to your registered email address. Please remember to check your spam or junk folder if the email is not found in your inbox.",

          "Is my personal data secure?" => "The security of your personal data is paramount. All your data is encrypted and will not be shared with third parties without your explicit consent. We adhere to high security standards to ensure the protection of your information.",

          "The website is inaccessible or showing errors. What should I do?" => "We apologize for any inconvenience caused. Please try refreshing the page, verifying your internet connection, or accessing the website using a different browser. If the error persists, there may be ongoing maintenance or a technical issue with our servers. Kindly report any such occurrences to our customer service team for prompt investigation and resolution.",

          // 6. Product Information
          "How do I find the correct product size?" => "On each product detail page, a specific size guide or size chart is typically provided. This information is crucial for selecting the appropriate size. Please refer to the product description section for details. Should you have further questions, our customer service team is available to assist.",

          "Are all displayed products always available?" => "Most products showcased on our website are readily available in stock. However, certain items may be available for pre-order or have limited stock. The availability status can be verified on the respective product detail pages. Notifications such as 'Limited Stock!' may appear for items with low inventory.",

          "I am looking for a specific product; is there a search feature?" => "Yes, a search bar is conveniently located at the top of the page. You may enter the product name or relevant keywords, and the search results will be displayed accordingly.",

          // 7. Customer Service
          "How can I contact customer service?" => "You may contact our customer service team via the following channels:
              Email: Send an email to fatihsabihisma2@gmail.com. We endeavor to respond as quickly as possible.
              Phone: Reach us at 089618577716 during our designated business hours (e.g., Monday-Friday, 09:00-17:00 WIB).
          Our team is prepared to assist you with your inquiries.",

          "When can customer service be contacted?" => "Our customer service team is available to assist you during our stated business hours [Day X-Y, Hour A-B WIB]. Outside of these hours, you may leave a message via email or the contact form, and we will respond promptly on the next business day."
      ];
      return view('components.about.faqs', [
        'faqs' => $faqs
      ]);
    }else if(strtolower($content) == 'terms-condition'){
      $termsCondition = [
        "Introduction" => "Welcome to [Your Website Name] (hereinafter referred to as the 'Website'). This Website is owned and operated by [Your Company Name / 'We']. By accessing or using this Website, you agree to be bound by these Terms and Conditions, our Privacy Policy, and all other guidelines or policies posted on the Website (collectively referred to as the 'Terms'). If you do not agree with these Terms, you may not access or use the Website.",

        "Definitions" => "In these Terms and Conditions:
        * 'Website' refers to [Your Website URL].
        * 'User' or 'You' refers to the individual or entity accessing or using this Website.
        * 'We', 'Our', 'Company' refers to [Your Company Name].
        * 'Product' refers to goods or services available for purchase through the Website.
        * 'Account' refers to a User's account created on the Website.",

            "Acceptance of Terms and Conditions" => "By accessing and using this Website, you represent that you have read, understood, and agree to be bound by these Terms. These Terms apply to all visitors, users, and others who access or use the Service.",

            "Account Usage Terms" => "a. **Account Registration:** To make purchases or access certain features on the Website, you may need to register and create an Account. You must provide accurate, complete, and current information during the registration process.
        b. **Account Confidentiality:** You are responsible for maintaining the confidentiality of your Account password and for all activities that occur under your Account. You agree to notify Us immediately of any unauthorized use of your Account or any other breach of security.
        c. **Account Termination:** We reserve the right to suspend or terminate your Account and refuse use of this Website, with or without cause, at any time, without prior notice, if you violate these terms.",

            "Product Information and Pricing" => "a. **Accuracy of Information:** We strive to ensure that product information, descriptions, images, and pricing on the Website are accurate and up-to-date. However, we do not warrant that all such information is free from errors, inaccuracies, or omissions.
        b. **Product Availability:** Product availability is subject to change without notice. Should a product become unavailable after you place an order, we will notify you and provide a refund or offer an alternative.
        c. **Price Changes:** Product prices are subject to change at any time without notice. The applicable price will be that displayed at the time you complete your order.",

            "Ordering and Payment" => "a. **Order Placement:** Upon placing an order, you will receive an order confirmation email. This email merely acknowledges that we have received your order and does not constitute acceptance of your order by Us. A contract of purchase will be formed when we send an email confirming that the Product has been dispatched.
        b. **Payment:** Payment for all orders must be made in full at the time of order placement. We accept payment methods displayed on the Website at checkout. You warrant that you are the lawful owner of the payment instrument used.",

            "Shipping and Delivery" => "a. **Delivery Schedule:** We will endeavor to process and dispatch your order within the timeframe specified at checkout. Delivery times may vary depending on your location and selected shipping options.
        b. **Risk of Loss:** The risk of loss and damage to Products transfers to you upon delivery of the Product to the courier or upon delivery to the specified address.
        c. **Address Inaccuracies:** We are not responsible for delays or failures in delivery caused by inaccurate or incomplete address information provided by you.",

            "Returns, Refunds, and Exchanges" => "Our policies regarding returns, refunds, and exchanges are described in more detail in our **Return Policy**, which forms an integral part of these Terms. Please refer to that policy for further information.",

            "Intellectual Property Rights" => "All content present on this Website, including but not limited to text, graphics, logos, icons, images, audio clips, digital downloads, data compilations, and software, is the property of [Your Company Name] or its content suppliers and is protected by copyright, trademark, and other intellectual property laws.",

            "Prohibited Uses" => "You must not use this Website for any purpose that is unlawful or prohibited by these Terms, including:
        a. Engaging in any activity that harms or disrupts the Website or other Users.
        b. Attempting to gain unauthorized access to any part of the Website, other Users' accounts, or computer systems or networks connected to the Website.
        c. Using the Website to transmit spam, unsolicited bulk email, or similar communications.
        d. Uploading or distributing viruses or other malicious code.
        e. Infringing upon the intellectual property rights of third parties.",

            "Disclaimer of Warranties" => "This Website is provided on an 'as is' and 'as available' basis without any warranties of any kind, either express or implied. We do not warrant that the Website will be error-free or uninterrupted, or that defects will be corrected. We disclaim all warranties, including, but not limited to, implied warranties of merchantability, fitness for a particular purpose, and non-infringement.",

            "Limitation of Liability" => "To the maximum extent permitted by applicable law, We, our directors, employees, partners, agents, suppliers, or affiliates shall not be liable for any indirect, incidental, special, consequential, or punitive damages, including, but not limited to, loss of profits, data, use, goodwill, or other intangible losses, resulting from:
        a. Your access to or use of or inability to access or use the Website;
        b. Any conduct or content of any third party on the Website;
        c. Any content obtained from the Website; and
        d. Unauthorized access, use, or alteration of your transmissions or content, whether based on warranty, contract, tort (including negligence), or any other legal theory, whether or not we have been informed of the possibility of such damage.",

            "Indemnification" => "You agree to defend, indemnify, and hold harmless [Your Company Name] and its licensees and licensors, and their employees, contractors, agents, officers, and directors, from and against any and all claims, damages, obligations, losses, liabilities, costs or debt, and expenses (including but not limited to attorney's fees), resulting from: a) your use and access of the Service by you or any person using your Account and password; b) your breach of these Terms; or c) your breach of any rights of a third party.",

            "Governing Law and Dispute Resolution" => "These Terms shall be governed and construed in accordance with the laws of [Your Country, e.g., the Republic of Indonesia], without regard to its conflict of law provisions. Any dispute arising from or related to these Terms shall be resolved exclusively in the competent courts located in [Your City, e.g., Jakarta, Indonesia].",

            "Changes to Terms" => "We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material, we will try to provide at least 30 days' notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion. By continuing to access or use our Website after those revisions become effective, you agree to be bound by the revised Terms.",

            "Contact Information" => "If you have any questions about these Terms, please contact us:
        * Via email: [Your Email Address]
        * Via the contact form on the Website: [Link to Your Contact Page]"
      ];
      return view('components.about.terms-condition', [
        'termsCondition' => $termsCondition
      ]);
    }else if(strtolower($content) == 'privacy'){
      $privacy = [
          "Introduction" => "This Privacy Policy describes how [Your Company Name] ('We', 'Us', or 'Our') collects, uses, and discloses your information when you visit, use, or make a purchase from [Your Website URL] (the 'Site'). By using the Site, you agree to the collection and use of information in accordance with this policy. This policy applies to all visitors, users, and others who access or use the Service.",

          "Information We Collect" => "We collect various types of information to provide and improve our Service to you. This may include:
          a. **Personal Information:** Data that can identify you directly or indirectly, such as your name, email address, postal address, phone number, payment information (though typically processed by third-party payment gateways), and other identifiable information you provide to us.
          b. **Usage Data:** Information on how the Service is accessed and used, which may include your computer's Internet Protocol (IP) address, browser type, browser version, the pages of our Site that you visit, the time and date of your visit, the time spent on those pages, unique device identifiers, and other diagnostic data.
          c. **Tracking & Cookies Data:** We use cookies and similar tracking technologies to track the activity on our Service and hold certain information. Cookies are files with a small amount of data which may include an anonymous unique identifier. You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.",

          "How We Collect Your Information" => "We collect information in several ways:
          a. **Directly from You:** When you register for an account, place an order, subscribe to our newsletter, respond to a survey, or communicate with our customer service.
          b. **Automatically:** As you navigate through the Site, we may automatically collect Usage Data and Tracking & Cookies Data using various technologies like cookies, web beacons, and pixels.
          c. **From Third Parties:** We may receive information about you from third-party partners, such as payment processors, shipping carriers, or marketing affiliates, in accordance with their privacy policies.",

          "How We Use Your Information" => "We use the collected data for various purposes, including but not limited to:
          a. To provide and maintain our Service, including processing your orders and managing your account.
          b. To notify you about changes to our Service.
          c. To allow you to participate in interactive features of our Service when you choose to do so.
          d. To provide customer support.
          e. To gather analysis or valuable information so that we can improve our Service.
          f. To monitor the usage of our Service.
          g. To detect, prevent, and address technical issues.
          h. To provide you with news, special offers, and general information about other goods, services, and events which we offer that are similar to those that you have already purchased or inquired about unless you have opted not to receive such information.
          i. To fulfill any other purpose for which you provide it.",

          "Sharing Your Information" => "We may share your personal information with third parties in the following situations:
          a. **Service Providers:** We may engage third-party companies and individuals to facilitate our Service, provide the Service on our behalf, perform Service-related services, or assist us in analyzing how our Service is used (e.g., payment processors, shipping companies, data analytics providers).
          b. **Business Transfers:** If we are involved in a merger, acquisition, or asset sale, your Personal Information may be transferred. We will provide notice before your Personal Information is transferred and becomes subject to a different Privacy Policy.
          c. **Legal Requirements:** We may disclose your Personal Information in the good faith belief that such action is necessary to: comply with a legal obligation; protect and defend the rights or property of [Your Company Name]; prevent or investigate possible wrongdoing in connection with the Service; protect the personal safety of users of the Service or the public; protect against legal liability.
          d. **With Your Consent:** We may disclose your personal information for any other purpose with your explicit consent.",

          "Data Security" => "The security of your data is important to us. While we strive to use commercially acceptable means to protect your Personal Information, we cannot guarantee its absolute security. No method of transmission over the Internet or method of electronic storage is 100% secure. We implement a variety of security measures to maintain the safety of your personal information when you place an order or enter, submit, or access your personal information.",

          "Data Retention" => "We will retain your Personal Information only for as long as is necessary for the purposes set out in this Privacy Policy. We will retain and use your Personal Information to the extent necessary to comply with our legal obligations (for example, if we are required to retain your data to comply with applicable laws), resolve disputes, and enforce our legal agreements and policies.",

          "Your Rights" => "Depending on your location, you may have certain rights regarding your personal data, including the right to:
          a. **Access:** Request a copy of the personal data we hold about you.
          b. **Correction:** Request that we correct any inaccurate or incomplete personal data.
          c. **Deletion:** Request that we delete your personal data under certain conditions.
          d. **Object to Processing:** Object to our processing of your personal data under certain conditions.
          e. **Data Portability:** Request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.
          f. **Withdraw Consent:** Withdraw your consent at any time where we relied on your consent to process your personal information.
          To exercise any of these rights, please contact us using the contact details provided below.",

          "Cookies and Tracking Technologies" => "We use cookies and similar tracking technologies to track the activity on our Service and hold certain information. Cookies are files with a small amount of data which may include an anonymous unique identifier. They are sent to your browser from a website and stored on your device. Other tracking technologies also used are beacons, tags, and scripts to collect and track information and to improve and analyze our Service. You can set your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.",

          "Third-Party Links" => "Our Service may contain links to other sites that are not operated by us. If you click on a third-party link, you will be directed to that third party's site. We strongly advise you to review the Privacy Policy of every site you visit. We have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.",

          "Children's Privacy" => "Our Service does not address anyone under the age of 18 ('Children'). We do not knowingly collect personally identifiable information from anyone under the age of 18. If you are a parent or guardian and you are aware that your Children have provided us with Personal Information, please contact us. If we become aware that we have collected Personal Information from children without verification of parental consent, we take steps to remove that information from our servers.",

          "Changes to This Policy" => "We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page. We will let you know via email and/or a prominent notice on our Service, prior to the change becoming effective and update the '[Date of Last Update]' at the top of this Privacy Policy. You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy Policy are effective when they are posted on this page.",

          "Contact Us" => "If you have any questions about this Privacy Policy, please contact us:
      * By email: [Your Email Address]
      * By visiting this page on our website: [Link to Your Contact Page]"
      ];

      return view('components.about.privacy', [
        'privacy' => $privacy
      ]);
    }else if(strtolower($content) == 'contact-us'){
      return view('components.about.contact-us');
    }

  })->name('about');


  Route::resource('cart', CartItemController::class)->parameters(['cart' => 'cartItem'])->names('cartItem');
  Route::resource('wishlist', WishlistController::class);
  Route::post('/wishlist/item/{productId}', [WishlistController::class, 'itemStore'])->name('wishlist.itemStore');
  Route::patch('/wishlist/item/{wishlistItem}', [WishlistController::class, 'itemUpdate'])->name('wishlist.itemUpdate');
  Route::delete('/wishlist/item/{wishlistItem}', [WishlistController::class, 'itemDestroy'])->name('wishlist.itemDestroy');
});


require __DIR__.'/auth.php';
