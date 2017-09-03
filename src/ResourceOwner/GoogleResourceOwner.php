<?php
/**
 * This file is part of the Devtronic oAuth Client package.
 *
 * Copyright 2017 by Julian Finkler <julian@developer-heaven.de>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Devtronic\OAuth\ResourceOwner;

class GoogleResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = 'https://accounts.google.com/o/oauth2/v2/auth';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = 'https://www.googleapis.com/oauth2/v3/token';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        # OpenID Connect
        'openid' => 'Authenticate using OpenID Connect',
        'profile' => 'View your basic profile info',
        'email' => 'View your email address',

        # Analytics Configuration and Reporting APIs
        'https://www.googleapis.com/auth/analytics' => 'View and manage your Google Analytics data',
        'https://www.googleapis.com/auth/analytics.edit' => 'Edit Google Analytics management entities',
        'https://www.googleapis.com/auth/analytics.manage.users' => 'Manage Google Analytics Account users by email address',
        'https://www.googleapis.com/auth/analytics.manage.users.readonly' => 'View Google Analytics user permissions',
        'https://www.googleapis.com/auth/analytics.provision' => 'Create a new Google Analytics account along with its default property and view',
        'https://www.googleapis.com/auth/analytics.readonly' => 'View your Google Analytics data',

        # Calendar API
        'https://www.googleapis.com/auth/calendar' => 'Manage your calendars',
        'https://www.googleapis.com/auth/calendar.readonly' => 'View your calendars',

        # Google People API, v1
        'https://www.googleapis.com/auth/contacts' => 'Manage your contacts',
        'https://www.googleapis.com/auth/contacts.readonly' => 'View your contacts',
        'https://www.googleapis.com/auth/user.addresses.read' => 'View your street addresses',
        'https://www.googleapis.com/auth/user.birthday.read' => 'View your complete date of birth',
        'https://www.googleapis.com/auth/user.emails.read' => 'View your email addresses',
        'https://www.googleapis.com/auth/user.phonenumbers.read' => 'View your phone numbers',
        'https://www.googleapis.com/auth/userinfo.email' => 'View your email address',
        'https://www.googleapis.com/auth/userinfo.profile' => 'View your basic profile info',

        # Cloud Print API
        'https://www.googleapis.com/auth/cloudprint' => 'Google Cloud Print',

        # Cloud Storage API
        'https://www.googleapis.com/auth/devstorage.full_control' => 'Manage your data and permissions in Google Cloud Storage',
        'https://www.googleapis.com/auth/devstorage.read_write' => 'Manage your data in Google Cloud Storage',

        # Fitness REST API
        'https://www.googleapis.com/auth/fitness.activity.read' => 'View your activity information in Google Fit',
        'https://www.googleapis.com/auth/fitness.activity.write' => 'View and store your activity information in Google Fit',
        'https://www.googleapis.com/auth/fitness.blood_glucose.read' => 'View blood glucose data in Google Fit',
        'https://www.googleapis.com/auth/fitness.blood_glucose.write' => 'View and store blood glucose data in Google Fit',
        'https://www.googleapis.com/auth/fitness.blood_pressure.read' => 'View blood pressure data in Google Fit',
        'https://www.googleapis.com/auth/fitness.blood_pressure.write' => 'View and store blood pressure data in Google Fit',
        'https://www.googleapis.com/auth/fitness.body.read' => 'View body sensor information in Google Fit',
        'https://www.googleapis.com/auth/fitness.body.write' => 'View and store body sensor data in Google Fit',
        'https://www.googleapis.com/auth/fitness.body_temperature.read' => 'View body temperature data in Google Fit',
        'https://www.googleapis.com/auth/fitness.body_temperature.write' => 'View and store body temperature data in Google Fit',
        'https://www.googleapis.com/auth/fitness.location.read' => 'View your stored location data in Google Fit',
        'https://www.googleapis.com/auth/fitness.location.write' => 'View and store your location data in Google Fit',
        'https://www.googleapis.com/auth/fitness.nutrition.read' => 'View nutrition information in Google Fit',
        'https://www.googleapis.com/auth/fitness.nutrition.write' => 'View and store nutrition information in Google Fit',
        'https://www.googleapis.com/auth/fitness.oxygen_saturation.read' => 'View oxygen saturation data in Google Fit',
        'https://www.googleapis.com/auth/fitness.oxygen_saturation.write' => 'View and store oxygen saturation data in Google Fit',
        'https://www.googleapis.com/auth/fitness.reproductive_health.read' => 'View reproductive health data in Google Fit',
        'https://www.googleapis.com/auth/fitness.reproductive_health.write' => 'View and store reproductive health data in Google Fit',

        # Fusion Tables API
        'https://www.googleapis.com/auth/fusiontables' => 'Manage your Fusion Tables',
        'https://www.googleapis.com/auth/fusiontables.readonly' => 'View your Fusion Tables',

        # YouTube Data and Live Streaming APIs
        'https://www.googleapis.com/auth/youtube' => 'Manage your YouTube account',
        'https://www.googleapis.com/auth/youtube.force-ssl' => 'Manage your YouTube account',
        'https://www.googleapis.com/auth/youtube.readonly' => 'View your YouTube account',
        'https://www.googleapis.com/auth/youtube.upload' => 'Manage your YouTube videos',
        'https://www.googleapis.com/auth/youtubepartner' => 'View and manage your assets and associated content on YouTube',
        'https://www.googleapis.com/auth/youtubepartner-channel-audit' => 'View private information of your YouTube channel relevant during the audit process with a YouTube partner',

        # Ad Exchange Buyer API, v1.4
        'https://www.googleapis.com/auth/adexchange.buyer' => 'Manage your Ad Exchange buyer account configuration',

        # Ad Exchange Seller API, v2.0
        'https://www.googleapis.com/auth/adexchange.seller' => 'View and manage your Ad Exchange data',
        'https://www.googleapis.com/auth/adexchange.seller.readonly' => 'View your Ad Exchange data',

        # Google Ad Experience Report API, v1
        'https://www.googleapis.com/auth/xapi.zoo' => 'Test scope for access to the Zoo service',

        # Admin Data Transfer API, datatransfer_v1
        'https://www.googleapis.com/auth/admin.datatransfer' => 'View and manage data transfers between users in your organization',
        'https://www.googleapis.com/auth/admin.datatransfer.readonly' => 'View data transfers between users in your organization',

        # Admin Directory API, directory_v1
        'https://www.googleapis.com/auth/admin.directory.customer' => 'View and manage customer related information',
        'https://www.googleapis.com/auth/admin.directory.customer.readonly' => 'View customer related information',
        'https://www.googleapis.com/auth/admin.directory.device.chromeos' => 'View and manage your Chrome OS devices\' metadata',
        'https://www.googleapis.com/auth/admin.directory.device.chromeos.readonly' => 'View your Chrome OS devices\' metadata',
        'https://www.googleapis.com/auth/admin.directory.device.mobile' => 'View and manage your mobile devices\' metadata',
        'https://www.googleapis.com/auth/admin.directory.device.mobile.action' => 'Manage your mobile devices by performing administrative tasks',
        'https://www.googleapis.com/auth/admin.directory.device.mobile.readonly' => 'View your mobile devices\' metadata',
        'https://www.googleapis.com/auth/admin.directory.domain' => 'View and manage the provisioning of domains for your customers',
        'https://www.googleapis.com/auth/admin.directory.domain.readonly' => 'View domains related to your customers',
        'https://www.googleapis.com/auth/admin.directory.group' => 'View and manage the provisioning of groups on your domain',
        'https://www.googleapis.com/auth/admin.directory.group.member' => 'View and manage group subscriptions on your domain',
        'https://www.googleapis.com/auth/admin.directory.group.member.readonly' => 'View group subscriptions on your domain',
        'https://www.googleapis.com/auth/admin.directory.group.readonly' => 'View groups on your domain',
        'https://www.googleapis.com/auth/admin.directory.notifications' => 'View and manage notifications received on your domain',
        'https://www.googleapis.com/auth/admin.directory.orgunit' => 'View and manage organization units on your domain',
        'https://www.googleapis.com/auth/admin.directory.orgunit.readonly' => 'View organization units on your domain',
        'https://www.googleapis.com/auth/admin.directory.resource.calendar' => 'View and manage the provisioning of calendar resources on your domain',
        'https://www.googleapis.com/auth/admin.directory.resource.calendar.readonly' => 'View calendar resources on your domain',
        'https://www.googleapis.com/auth/admin.directory.rolemanagement' => 'Manage delegated admin roles for your domain',
        'https://www.googleapis.com/auth/admin.directory.rolemanagement.readonly' => 'View delegated admin roles for your domain',
        'https://www.googleapis.com/auth/admin.directory.user' => 'View and manage the provisioning of users on your domain',
        'https://www.googleapis.com/auth/admin.directory.user.alias' => 'View and manage user aliases on your domain',
        'https://www.googleapis.com/auth/admin.directory.user.alias.readonly' => 'View user aliases on your domain',
        'https://www.googleapis.com/auth/admin.directory.user.readonly' => 'View users on your domain',
        'https://www.googleapis.com/auth/admin.directory.user.security' => 'Manage data access permissions for users on your domain',
        'https://www.googleapis.com/auth/admin.directory.userschema' => 'View and manage the provisioning of user schemas on your domain',
        'https://www.googleapis.com/auth/admin.directory.userschema.readonly' => 'View user schemas on your domain',

        # Admin Reports API, reports_v1
        'https://www.googleapis.com/auth/admin.reports.audit.readonly' => 'View audit reports for your G Suite domain',
        'https://www.googleapis.com/auth/admin.reports.usage.readonly' => 'View usage reports for your G Suite domain',

        # AdSense Management API, v1.4
        'https://www.googleapis.com/auth/adsense' => 'View and manage your AdSense data',
        'https://www.googleapis.com/auth/adsense.readonly' => 'View your AdSense data',

        # AdSense Host API, v4.1
        'https://www.googleapis.com/auth/adsensehost' => 'View and manage your AdSense host data and associated accounts',

        # Google Play EMM API, v1
        'https://www.googleapis.com/auth/androidenterprise' => 'Manage corporate Android devices',

        # Google Play Developer API, v2
        'https://www.googleapis.com/auth/androidpublisher' => 'View and manage your Google Play Developer account',

        # Google App Engine Admin API, v1
        'https://www.googleapis.com/auth/appengine.admin' => 'View and manage your applications deployed on Google App Engine',
        'https://www.googleapis.com/auth/cloud-platform' => 'View and manage your data across Google Cloud Platform services',
        'https://www.googleapis.com/auth/cloud-platform.read-only' => 'View your data across Google Cloud Platform services',

        # G Suite Activity API, v1
        'https://www.googleapis.com/auth/activity' => 'View the activity history of your Google apps',

        # Google App State API, v1
        'https://www.googleapis.com/auth/appstate' => 'View and manage your data for this application',

        # BigQuery API, v2
        'https://www.googleapis.com/auth/bigquery' => 'View and manage your data in Google BigQuery',
        'https://www.googleapis.com/auth/bigquery.insertdata' => 'Insert data Google BigQuery',

        # Blogger API, v3
        'https://www.googleapis.com/auth/blogger' => 'Manage your Blogger account',
        'https://www.googleapis.com/auth/blogger.readonly' => 'View your Blogger account',

        # Books API, v1
        'https://www.googleapis.com/auth/books' => 'Manage your books',

        # Google Classroom API, v1
        'https://www.googleapis.com/auth/classroom.courses' => 'Manage your Google Classroom classes',
        'https://www.googleapis.com/auth/classroom.courses.readonly' => 'View your Google Classroom classes',
        'https://www.googleapis.com/auth/classroom.coursework.me' => 'Manage your course work and view your grades in Google Classroom',
        'https://www.googleapis.com/auth/classroom.coursework.me.readonly' => 'View your course work and grades in Google Classroom',
        'https://www.googleapis.com/auth/classroom.coursework.students' => 'Manage course work and grades for students in the Google Classroom classes you teach and view the course work and grades for classes you administer',
        'https://www.googleapis.com/auth/classroom.coursework.students.readonly' => 'View course work and grades for students in the Google Classroom classes you teach or administer',
        'https://www.googleapis.com/auth/classroom.guardianlinks.me.readonly' => 'View your Google Classroom guardians',
        'https://www.googleapis.com/auth/classroom.guardianlinks.students' => 'View and manage guardians for students in your Google Classroom classes',
        'https://www.googleapis.com/auth/classroom.guardianlinks.students.readonly' => 'View guardians for students in your Google Classroom classes',
        'https://www.googleapis.com/auth/classroom.profile.emails' => 'View the email addresses of people in your classes',
        'https://www.googleapis.com/auth/classroom.profile.photos' => 'View the profile photos of people in your classes',
        'https://www.googleapis.com/auth/classroom.rosters' => 'Manage your Google Classroom class rosters',
        'https://www.googleapis.com/auth/classroom.rosters.readonly' => 'View your Google Classroom class rosters',
        'https://www.googleapis.com/auth/classroom.student-submissions.me.readonly' => 'View your course work and grades in Google Classroom',
        'https://www.googleapis.com/auth/classroom.student-submissions.students.readonly' => 'View course work and grades for students in the Google Classroom classes you teach or administer',

        # Stackdriver Debugger API, v2
        'https://www.googleapis.com/auth/cloud_debugger' => 'Manage cloud debugger',

        # Cloud Monitoring API, v2beta2
        'https://www.googleapis.com/auth/monitoring' => 'View and write monitoring data for all of your Google and third-party Cloud and API projects',
        'https://www.googleapis.com/auth/monitoring.read' => 'View monitoring data for all of your Google Cloud and third-party projects',
        'https://www.googleapis.com/auth/monitoring.write' => 'Publish metric data to your Google Cloud projects',

        # Cloud User Accounts API, vm_alpha
        'https://www.googleapis.com/auth/cloud.useraccounts' => 'Manage your Google Cloud User Accounts',
        'https://www.googleapis.com/auth/cloud.useraccounts.readonly' => 'View your Google Cloud User Accounts',

        # Content API for Shopping, v2
        'https://www.googleapis.com/auth/content' => 'Manage your product listings and accounts for Google Shopping',

        # Google Cloud Datastore API, v1
        'https://www.googleapis.com/auth/datastore' => 'View and manage your Google Cloud Datastore data',

        # Google Cloud Deployment Manager API, v2
        'https://www.googleapis.com/auth/ndev.cloudman' => 'View and manage your Google Cloud Platform management resources and deployment status information',
        'https://www.googleapis.com/auth/ndev.cloudman.readonly' => 'View your Google Cloud Platform management resources and deployment status information',

        # DCM/DFA Reporting And Trafficking API, v2.8
        'https://www.googleapis.com/auth/ddmconversions' => 'Manage DoubleClick Digital Marketing conversions',
        'https://www.googleapis.com/auth/dfareporting' => 'View and manage DoubleClick for Advertisers reports',
        'https://www.googleapis.com/auth/dfatrafficking' => 'View and manage your DoubleClick Campaign Manager\'s (DCM) display ad campaigns',

        # Google Cloud DNS API, v1
        'https://www.googleapis.com/auth/ndev.clouddns.readonly' => 'View your DNS records hosted by Google Cloud DNS',
        'https://www.googleapis.com/auth/ndev.clouddns.readwrite' => 'View and manage your DNS records hosted by Google Cloud DNS',

        # DoubleClick Bid Manager API, v1
        'https://www.googleapis.com/auth/doubleclickbidmanager' => 'View and manage your reports in DoubleClick Bid Manager',

        # DoubleClick Search API, v2
        'https://www.googleapis.com/auth/doubleclicksearch' => 'View and manage your advertising data in DoubleClick Search',

        # Drive API, v3
        'https://www.googleapis.com/auth/drive' => 'View and manage the files in your Google Drive',
        'https://www.googleapis.com/auth/drive.appdata' => 'View and manage its own configuration data in your Google Drive',
        'https://www.googleapis.com/auth/drive.file' => 'View and manage Google Drive files and folders that you have opened or created with this app',
        'https://www.googleapis.com/auth/drive.metadata' => 'View and manage metadata of files in your Google Drive',
        'https://www.googleapis.com/auth/drive.metadata.readonly' => 'View metadata for files in your Google Drive',
        'https://www.googleapis.com/auth/drive.photos.readonly' => 'View the photos, videos and albums in your Google Photos',
        'https://www.googleapis.com/auth/drive.readonly' => 'View the files in your Google Drive',
        'https://www.googleapis.com/auth/drive.scripts' => 'Modify your Google Apps Script scripts\' behavior',

        # Firebase Rules API, v1
        'https://www.googleapis.com/auth/firebase' => 'View and administer all your Firebase data and settings',
        'https://www.googleapis.com/auth/firebase.readonly' => 'View all your Firebase data and settings',

        # Google Play Game Services API, v1
        'https://www.googleapis.com/auth/games' => 'Share your Google+ profile information and view and manage your game activity',

        # Genomics API, v1
        'https://www.googleapis.com/auth/genomics' => 'View and manage Genomics data',
        'https://www.googleapis.com/auth/genomics.readonly' => 'View Genomics data',

        # Gmail API, v1
        'https://mail.google.com/' => 'Read, send, delete, and manage your email',
        'https://www.googleapis.com/auth/gmail.compose' => 'Manage drafts and send emails',
        'https://www.googleapis.com/auth/gmail.insert' => 'Insert mail in to your mailbox',
        'https://www.googleapis.com/auth/gmail.labels' => 'Manage mailbox labels',
        'https://www.googleapis.com/auth/gmail.metadata' => 'View your email message metadata such as labels and headers, but not the email body',
        'https://www.googleapis.com/auth/gmail.modify' => 'View and modify but not delete your email',
        'https://www.googleapis.com/auth/gmail.readonly' => 'View your emails messages and settings',
        'https://www.googleapis.com/auth/gmail.send' => 'Send email on your behalf',
        'https://www.googleapis.com/auth/gmail.settings.basic' => 'Manage your basic mail settings',
        'https://www.googleapis.com/auth/gmail.settings.sharing' => 'Manage your sensitive mail settings, including who can manage your mail',

        # Groups Migration API, v1
        'https://www.googleapis.com/auth/apps.groups.migration' => 'Manage messages in groups on your domain',

        # Groups Settings API, v1
        'https://www.googleapis.com/auth/apps.groups.settings' => 'View and manage the settings of a G Suite group',

        # Google Cloud Natural Language API, v1
        'https://www.googleapis.com/auth/cloud-language' => 'Apply machine learning models to reveal the structure and meaning of text',

        # Enterprise License Manager API, v1
        'https://www.googleapis.com/auth/apps.licensing' => 'View and manage G Suite licenses for your domain',

        # Stackdriver Logging API, v2
        'https://www.googleapis.com/auth/logging.admin' => 'Administrate log data for your projects',
        'https://www.googleapis.com/auth/logging.read' => 'View log data for your projects',
        'https://www.googleapis.com/auth/logging.write' => 'Submit log data for your projects',

        # Manufacturer Center API, v1
        'https://www.googleapis.com/auth/manufacturercenter' => 'Manage your product listings for Google Manufacturer Center',

        # Google Mirror API, v1
        'https://www.googleapis.com/auth/glass.location' => 'View your location',
        'https://www.googleapis.com/auth/glass.timeline' => 'View and manage your Glass timeline',

        # Google Play Movies Partner API, v1
        'https://www.googleapis.com/auth/playmovies_partner.readonly' => 'View the digital assets you publish on Google Play Movies and TV',

        # Google+ API, v1
        'https://www.googleapis.com/auth/plus.login' => 'Know the list of people in your circles, your age range, and language',
        'https://www.googleapis.com/auth/plus.me' => 'Know who you are on Google',

        # Google+ Domains API, v1
        'https://www.googleapis.com/auth/plus.circles.read' => 'View your circles and the people and pages in them',
        'https://www.googleapis.com/auth/plus.circles.write' => 'Manage your circles and add people and pages. People and pages you add to your circles will be notified. Others may see this information publicly. People you add to circles can use Hangouts with you.',
        'https://www.googleapis.com/auth/plus.media.upload' => 'Send your photos and videos to Google+',
        'https://www.googleapis.com/auth/plus.profiles.read' => 'View your own Google+ profile and profiles visible to you',
        'https://www.googleapis.com/auth/plus.stream.read' => 'View your Google+ posts, comments, and stream',
        'https://www.googleapis.com/auth/plus.stream.write' => 'Manage your Google+ posts, comments, and stream',

        # Prediction API, v1.6
        'https://www.googleapis.com/auth/prediction' => 'Manage your data in the Google Prediction API',

        # Google Proximity Beacon API, v1beta1
        'https://www.googleapis.com/auth/userlocation.beacon.registry' => 'View and modify your beacons',

        # Google Cloud Pub/Sub API, v1
        'https://www.googleapis.com/auth/pubsub' => 'View and manage Pub/Sub topics and subscriptions',

        # Google Compute Engine Instance Group Updater API, v1beta1
        'https://www.googleapis.com/auth/replicapool' => 'View and manage replica pools',
        'https://www.googleapis.com/auth/replicapool.readonly' => 'View replica pools',

        # Enterprise Apps Reseller API, v1
        'https://www.googleapis.com/auth/apps.order' => 'Manage users on your domain',
        'https://www.googleapis.com/auth/apps.order.readonly' => 'Manage users on your domain',

        # Google Cloud Runtime Configuration API, v1
        'https://www.googleapis.com/auth/cloudruntimeconfig' => 'Manage your Google Cloud Platform services\' runtime configuration',

        # Google Apps Script Execution API, v1
        'https://www.google.com/calendar/feeds' => 'Manage your calendars',
        'https://www.google.com/m8/feeds' => 'Manage your contacts',
        'https://www.googleapis.com/auth/forms' => 'View and manage your forms in Google Drive',
        'https://www.googleapis.com/auth/forms.currentonly' => 'View and manage forms that this application has been installed in',
        'https://www.googleapis.com/auth/groups' => 'View and manage your Google Groups',

        # Google Cloud Service Control, alpha
        'servicecontrol' => 'Report usage across Google managed services',
        'cloud-platform' => 'View and manage your data across Google Cloud Platform services',

        # Google Cloud Service Management, alpha
        'service.management' => 'Manage your Google API service configuration',

        # Google Service Control API, v1
        'https://www.googleapis.com/auth/servicecontrol' => 'Manage your Google Service Control data',

        # Google Service Management API, v1
        'https://www.googleapis.com/auth/service.management' => 'Manage your Google API service configuration',
        'https://www.googleapis.com/auth/service.management.readonly' => 'View your Google API service configuration',

        # Google Sheets API, v4
        'https://www.googleapis.com/auth/spreadsheets' => 'View and manage your spreadsheets in Google Drive',
        'https://www.googleapis.com/auth/spreadsheets.readonly' => 'View your Google Spreadsheets',

        # Google Site Verification API, v1
        'https://www.googleapis.com/auth/siteverification' => 'Manage the list of sites and domains you control',
        'https://www.googleapis.com/auth/siteverification.verify_only' => 'Manage your new site verifications with Google',

        # Google Slides API, v1
        'https://www.googleapis.com/auth/presentations' => 'View and manage your Google Slides presentations',
        'https://www.googleapis.com/auth/presentations.readonly' => 'View your Google Slides presentations',

        # Cloud Source Repositories API, v1
        'https://www.googleapis.com/auth/source.read_only' => 'View the contents of your source code repositories',
        'https://www.googleapis.com/auth/source.read_write' => 'Manage the contents of your source code repositories',

        # Cloud Spanner API, v1
        'https://www.googleapis.com/auth/spanner.admin' => 'Administer your Spanner databases',
        'https://www.googleapis.com/auth/spanner.data' => 'View and manage the contents of your Spanner databases',

        # Cloud SQL Administration API, v1beta4
        'https://www.googleapis.com/auth/sqlservice.admin' => 'Manage your Google SQL Service instances',

        # Cloud Storage JSON API, v1
        'https://www.googleapis.com/auth/devstorage.read_only' => 'View your data in Google Cloud Storage',

        # Tag Manager API, v2
        'https://www.googleapis.com/auth/tagmanager.delete.containers' => 'Delete your Google Tag Manager containers',
        'https://www.googleapis.com/auth/tagmanager.edit.containers' => 'Manage your Google Tag Manager container and its subcomponents, excluding versioning and publishing',
        'https://www.googleapis.com/auth/tagmanager.edit.containerversions' => 'Manage your Google Tag Manager container versions',
        'https://www.googleapis.com/auth/tagmanager.manage.accounts' => 'View and manage your Google Tag Manager accounts',
        'https://www.googleapis.com/auth/tagmanager.manage.users' => 'Manage user permissions of your Google Tag Manager account and container',
        'https://www.googleapis.com/auth/tagmanager.publish' => 'Publish your Google Tag Manager container versions',
        'https://www.googleapis.com/auth/tagmanager.readonly' => 'View your Google Tag Manager container and its subcomponents',

        # TaskQueue API, v1beta2
        'https://www.googleapis.com/auth/taskqueue' => 'Manage your Tasks and Taskqueues',
        'https://www.googleapis.com/auth/taskqueue.consumer' => 'Consume Tasks from your Taskqueues',

        # Tasks API, v1
        'https://www.googleapis.com/auth/tasks' => 'Manage your tasks',
        'https://www.googleapis.com/auth/tasks.readonly' => 'View your tasks',

        # Google Cloud Translation API, v2
        'https://www.googleapis.com/auth/cloud-translation' => 'Translate text from one language to another using Google Translate',

        # URL Shortener API, v1
        'https://www.googleapis.com/auth/urlshortener' => 'Manage your goo.gl short URLs',

        # Search Console API, v3
        'https://www.googleapis.com/auth/webmasters' => 'View and manage Search Console data for your verified sites',
        'https://www.googleapis.com/auth/webmasters.readonly' => 'View Search Console data for your verified sites',

        # YouTube Analytics API, v1
        'https://www.googleapis.com/auth/yt-analytics-monetary.readonly' => 'View monetary and non-monetary YouTube Analytics reports for your YouTube content',
        'https://www.googleapis.com/auth/yt-analytics.readonly' => 'View YouTube Analytics reports for your YouTube content',
    ];
}
