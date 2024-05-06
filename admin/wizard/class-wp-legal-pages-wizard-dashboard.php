<?php
/**
 * WPLegalPages Dashboard.
 *
 * This class defines all the pages on wizard dashboard.
 * 
 * @category   X
 * @package    WP_Legal_Pages
 * @subpackage WP_Legal_Pages/admin/wizard
 * @author     WPEka <support@wplegalpages.com>
 * @license    username@example.com X
 * @link       https://wplegalpages.com/
 * @since      1.5.2
 */

if (! class_exists('WP_Legal_Pages_Wizard_Dashboard')) {

    /**
     * WPLegalPages Dashboard.
     *
     * This class defines all the pages on wizard dashboard.
     *
     * @category   X
     * @package    WP_Legal_Pages
     * @subpackage WP_Legal_Pages/admin/wizard
     * @author     WPEka <support@wplegalpages.com>
     * @license    username@example.com X
     * @link       https://wplegalpages.com/
     * @since      1.5.2
     */
    class WP_Legal_Pages_Wizard_Dashboard 
    {

        /**
         * Legal Pages Array.
         *
         * @var array $legal_pages legalpages
         */
        public $legal_pages = array();

        /**
         * Pro Legal Pages Array.
         *
         * @var array $pro_legalpages legalpages
         */
        public $pro_legalpages = array();

        /**
         * Initialize the class and set its properties.
         *
         * @since 1.0.0
         */
        public function __construct() 
        {
            $this->legal_pages = array(
                'Available Templates' => array(
                    'standard_privacy_policy' => array(
                        'title'   => __('Standard Privacy Policy', 'wplegalpages'),
                        'desc'    => __('If you collect any personal data from user.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'lang'    => array('English'),
                        'enabled' => true,),
                    'terms_of_use_free'       => array(
                        'title'   => __('Terms of Use', 'wplegalpages'),
                        'desc'    => __('If you want to protect your business.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'lang'    => array('English', 'French', 'German'),
                        'enabled' => true,),
                    'dmca'                    => array(
                        'title'   => __('DMCA', 'wplegalpages'),
                        'desc'    => __('To limit your liability to copyright infringement claims.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'lang'    => array('English'),
                        'enabled' => true,),
                    'ccpa_free'               => array(
                        'title'   => __('Standard CCPA', 'wplegalpages'),
                        'desc'    => __('If you are collecting personal data and have California based users.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'lang'    => array('English'),
                        'enabled' => true,),),);
            //pro templates.
            $pro_templates = array(
                'Popular'     => array(
                    'privacy_policy'            => array(
                        'title'   => __('Professional Privacy Policy', 'wplegalpages'),
                        'desc'    => __('If you collect any personal data from users (GDPR and CCPA compliant)', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'terms_of_use'              => array(
                        'title'   => __('Terms and Conditions', 'wplegalpages'),
                        'desc'    => __('If you want to protect your business.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'lang'    => array('English', 'Spanish'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'returns_refunds_policy'    => array(
                        'title'   => __('Returns & Refunds Policy', 'wplegalpages'),
                        'desc'    => __('If you want to protect your e-Commerce business.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'impressum'                 => array(
                        'title'   => __('Impressum', 'wplegalpages'),
                        'desc'    => __('If you want to issue a statement of ownership and authorship of your content.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'california_privacy_policy' => array(
                        'title'   => __('Professional CCPA', 'wplegalpages'),
                        'desc'    => __('If you have California based users and want to give them clarity on disclosure of personal information.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'coppa'                     => array(
                        'title'   => __('COPPA', 'wplegalpages'),
                        'desc'    => __('If you are collecting personal information on your website from children below 13 years in age.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'terms_forced'              => array(
                        'title'   => __('Terms(forced agreement)', 'wplegalpages'),
                        'desc'    => __('Use when you don\'t want your users to proceed without agreeing to website terms.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'custom_legal'              => array(
                        'title'   => __('Create Custom Legal Page', 'wplegalpages'),
                        'desc'    => __('Add your own text to create a custom legal policy.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),),
                'Policies'    => array(
                    'gdpr_cookie_policy'   => array(
                        'title'   => __('GDPR Cookie Policy', 'wplegalpages'),
                        'desc'    => __('Use when you have visitors from the EU & are using cookies on your website.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'gdpr_privacy_policy'  => array(
                        'title'   => __('GDPR Privacy Policy', 'wplegalpages'),
                        'desc'    => __('Use when your website collects personal information and has visitors from the EU.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'cookies_policy'       => array(
                        'title'   => __('Cookies Policy', 'wplegalpages'),
                        'desc'    => __('To inform users about the cookies active on your website that track user data.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'blog_comments_policy' => array(
                        'title'   => __('Blog Comments Policy', 'wplegalpages'),
                        'desc'    => __('Use when you have comments enabled on your blog.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'linking_policy'       => array(
                        'title'   => __('Linking Policy', 'wplegalpages'),
                        'desc'    => __('Use this policy to inform the users about the terms and conditions for linking to your website and disclaimers for external linking.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'external_link_policy' => array(
                        'title'   => __('External Links Policy', 'wplegalpages'),
                        'desc'    => __('If your website links to other external websites, you can use this to ensure that the external links are in compliance with the applicable laws.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'fb_policy'            => array(
                        'title'   => __('Facebook Policy', 'wplegalpages'),
                        'desc'    => __('If you are collecting any personal data from your page through a call to action (such as email addresses for your mailing list).', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'digital_goods_refund_policy'    => array(
                        'title'   => __('Digital Goods Refund Policy', 'wplegalpages'),
                        'desc'    => __("If selling digital goods, having a 'Digital Goods Refund Policy' provides clarity, outlining fair and transparent guidelines.", 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),)),
                'Disclosures' => array(
                    'affiliate_disclosure'        => array(
                        'title'   => __('Affiliate Disclosure', 'wplegalpages'),
                        'desc'    => __('To inform your audience about your affiliate relationships with brands, products, or companies that you publicly recommend.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'amazon_affiliate_disclosure' => array(
                        'title'   => __('Amazon Affiliate Disclosure', 'wplegalpages'),
                        'desc'    => __('To comply with Amazon’s affiliate program requirements (if you promote products listed on amazon).', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'testimonials_disclosure'     => array(
                        'title'   => __('Testimonials Disclosure ', 'wplegalpages'),
                        'desc'    => __('Use this if your website displays user reviews or endorsements.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'confidentiality_disclosure'  => array(
                        'title'   => __('Confidentiality Disclosure ', 'wplegalpages'),
                        'desc'    => __('To protect confidential and proprietary information displayed on your website.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'advertising_disclosure' => array(
                        'title'=> __('Advertising Disclosure', 'wplegalpages'),
                        'desc'=> __("If you promote products or services on your website an 'Advertising Disclosure' page ensures transparency and compliance.", 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),)),
                'Disclaimers' => array(
                    'general_disclaimer'  => array(
                        'title'   => __('General Disclaimer', 'wplegalpages'),
                        'desc'    => __('To limit your legal liability and keep your users informed.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'earnings_disclaimer' => array(
                        'title'   => __('Earnings Disclaimer', 'wplegalpages'),
                        'desc'    => __('To limit your legal liability if your website is promoting strategies and programs to help users make money.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'medical_disclaimer'  => array(
                        'title'   => __('Medical Disclaimer', 'wplegalpages'),
                        'desc'    => __('To imply that the information on your website is not intended to be a substitute for professional medical advice, diagnosis, or treatment.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'newsletters'         => array(
                        'title'   => __('Newsletter: Subscription & Disclaimer', 'wplegalpages'),
                        'desc'    => __('If you are using an email newsletter service and collect personal information like email id from your subscribers.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),),
                'Other'       => array(
                    'affiliate_agreement' => array(
                        'title'   => __('Affiliate Agreement', 'wplegalpages'),
                        'desc'    => __('For a legal contract between you and your affiliates who promote your products/services.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'antispam'            => array(
                        'title'   => __('Antispam', 'wplegalpages'),
                        'desc'    => __('If you are an individual/business that uses email for advertising or promoting something.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'ftc_statement'       => array(
                        'title'   => __('FTC Statement', 'wplegalpages'),
                        'desc'    => __('If you have a website and have affiliate partners, you should declare your website’s compliance with the Federal Trade Commission policies.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'double_dart'         => array(
                        'title'   => __('Double Dart Cookies', 'wplegalpages'),
                        'desc'    => __('To notify users if your website or blog is using any Double Click Dart Cookie.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'cpra'                => array(
                        'title'   => __('CPRA - California Privacy Rights Act', 'wplegalpages'),
                        'desc'    => __('If you have users from California and want to give them clarity on the disclosure of personal information..', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'about_us'            => array(
                        'title'   => __('About Us', 'wplegalpages'),
                        'desc'    => __('To display your contact and mailing information.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),
                    'end_user_license'            => array(
                        'title'   => __('End User License Agreement', 'wplegalpages'),
                        'desc'    => __('If you use software or online services, a EULA sets usage guidelines and legal boundaries.', 'wplegalpages'),
                        'btn_txt' => __('Create', 'wplegalpages'),
                        'enabled' => true,
                        'is_pro'  => __('PRO', 'wplegalpages'),),),);

            $this->legal_pages = array_merge($this->legal_pages, $pro_templates);


        }

        /**
         * Get Legal Pages.
         *
         * @return array $legal_pages legal pages.
         */
        public function get_legal_pages() 
        {
            return $this->legal_pages;
        }

        /**
         * Get Pro Legal Pages
         *
         * @return array $pro_legalpages legal pages.
         */
        public function get_pro_legal_pages() 
        {
            return $this->pro_legalpages;
        }

    }
}
