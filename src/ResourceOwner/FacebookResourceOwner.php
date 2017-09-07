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

class FacebookResourceOwner extends OAuth2ResourceOwner
{
    /**
     * The URL for authorizing
     * @var string
     */
    protected $authorizeUrl = 'https://graph.facebook.com/v2.10/oauth/authorize';

    /**
     * The URL for tokens
     * @var string
     */
    protected $tokenUrl = 'https://graph.facebook.com/v2.10/oauth/access_token';

    /**
     * The available scopes
     * Key = Scope name, Value = Description
     * @var array
     */
    protected $scopes = [
        'public_profile' => 'Provides access to a subset of items that are part of a person\'s public profile.',
        'user_friends' => 'Provides access the list of friends that also use your app.',
        'email' => 'Provides access to the person\'s primary email address via the email property on the user object.',
        'user_about_me' => 'Provides access to a person\'s personal description (the \'About Me\' section on their Profile) through the User object.',
        'user_actions.books' => 'Provides access to all common books actions published by any app the person has used.',
        'user_actions.fitness' => 'Provides access to all common Open Graph fitness actions published by any app the person has used.',
        'user_actions.music' => 'Provides access to all common Open Graph music actions published by any app the person has used.',
        'user_actions.news' => 'Provides access to all common Open Graph news actions published by any app the person has used which publishes these actions',
        'user_actions.video' => 'Provides access to all common Open Graph video actions published by any app the person has used which publishes these actions.',
        'user_birthday' => 'Access the date and month of a person\'s birthday.',
        'user_education_history' => 'Provides access to a person\'s education history through the education field on the User object.',
        'user_events' => 'Provides read-only access to the Events a person is hosting or has RSVP\'d to.',
        'user_games_activity' => 'Provides access to read a person\'s game activity (scores, achievements) in any game the person has played.',
        'user_hometown' => 'Provides access to a person\'s hometown location through the hometown field on the User object.',
        'user_likes' => 'Provides access to the list of all Facebook Pages and Open Graph objects that a person has liked.',
        'user_location' => 'Provides access to a person\'s current city through the location field on the User object.',
        'user_managed_groups' => 'Lets your app read the content of groups a person is an admin of through the Groups edge on the User object.',
        'user_photos' => 'Provides access to the photos a person has uploaded or been tagged in.',
        'user_posts' => 'Provides access to the posts on a person\'s Timeline. Includes their own posts, posts they are tagged in, and posts other people make on their Timeline.',
        'user_relationships' => 'Provides access to a person\'s relationship status, significant other and family members as fields on the User object.',
        'user_relationship_details' => 'Provides access to a person\'s relationship interests as the interested_in field on the User object.',
        'user_religion_politics' => 'Provides access to a person\'s religious and political affiliations.',
        'user_tagged_places' => 'Provides access to the Places a person has been tagged at in photos, videos, statuses and links.',
        'user_videos' => 'Provides access to the videos a person has uploaded or been tagged in.',
        'user_website' => 'Provides access to the person\'s personal website URL via the website field on the User object.',
        'user_work_history' => 'Provides access to a person\'s work history and list of employers via the work field on the User object.',
        'read_custom_friendlists' => 'Provides access to the names of custom lists a person has created to organize their friends.',
        'read_insights' => 'Provides read-only access to the Insights data for Pages, Apps and web domains the person owns.',
        'read_audience_network_insights' => 'Provides read-only access to the Audience Network Insights data for Apps the person owns.',
        'read_page_mailboxes' => 'Provides the ability to read from the Page Inboxes of the Pages managed by a person. This permission is often used alongside the manage_pages permission.',
        'manage_pages' => 'Enables your app to retrieve Page Access Tokens for the Pages and Apps that the person administrates.',
        'publish_pages' => 'When you also have the manage_pages permission, gives your app the ability to post, comment and like as any of the Pages managed by a person using your app.',
        'publish_actions' => 'Provides access to publish Posts, Open Graph actions, achievements, scores and other activity on behalf of a person using your app.',
        'rsvp_event' => 'Provides the ability to set a person\'s attendee status on Facebook Events (e.g. attending, maybe, or declined).',
        'pages_show_list' => 'Provides the access to show the list of the Pages that you manage.',
        'pages_manage_cta' => 'Provides the access to manage call to actions of the Pages that you manage.',
        'pages_manage_instant_articles' => 'Lets your app manage Instant Articles on behalf of Facebook Pages administered by people using your app.',
        'ads_read' => 'Provides the access to Ads Insights API to pull ads report information for ad accounts you have access to.',
        'ads_management' => 'Provides the ability to both read and manage the ads for ad accounts you have access to.',
        'business_management' => 'Read and write with Business Management API',
        'pages_messaging' => 'This allows you to send and receive messages through a Facebook Page, but only within 24h hours after a user action.',
        'pages_messaging_subscriptions' => 'This allows you to send and receive messages through a Facebook Page out of the 24h window opened by a user action.',
        'pages_messaging_phone_number' => 'This allows you to charge users in Messenger conversations on behalf of pages. Intended for tangible goods only, not virtual or subscriptions.',
    ];
}
