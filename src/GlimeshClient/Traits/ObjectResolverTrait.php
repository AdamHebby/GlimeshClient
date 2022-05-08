<?php

namespace GlimeshClient\Traits;

use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Trait for Resolving Glimesh Objects
 *
 * @author Adam Hebden <adam@adamhebden.com>
 * @copyright 2021 Adam Hebden
 * @license GPL-3.0-or-later
 * @package GlimeshClient
 */
trait ObjectResolverTrait
{
    /**
     * keys that contain multiple objects, makes us return ObjectArray of this class
     *
     * @var array
     */
    protected static $mappingMulitple = [
        'bans'           => \GlimeshClient\Objects\ChannelBan::class,
        'categories'     => \GlimeshClient\Objects\Category::class,
        'channels'       => \GlimeshClient\Objects\Channel::class,
        'chatMessages'   => \GlimeshClient\Objects\ChatMessage::class,
        'followers'      => \GlimeshClient\Objects\Follower::class,
        'following'      => \GlimeshClient\Objects\Follower::class,
        'moderationLogs' => \GlimeshClient\Objects\ChannelModerationLog::class,
        'moderators'     => \GlimeshClient\Objects\ChannelModerator::class,
        'streamers'      => \GlimeshClient\Objects\User::class,
        'streams'        => \GlimeshClient\Objects\Stream::class,
        'subcategories'  => \GlimeshClient\Objects\Subcategory::class,
        'subscriptions'  => \GlimeshClient\Objects\Sub::class,
        'tags'           => \GlimeshClient\Objects\Tag::class,
        'tokens'         => \GlimeshClient\Interfaces\ChatMessageToken::class,
        'users'          => \GlimeshClient\Objects\User::class,
    ];

    /**
-     * Single ojects
-     *
-     * @var array
-     */
    protected static $mappingSingle = [
        'ban'                   => \GlimeshClient\Objects\ChannelBan::class,
        'category'              => \GlimeshClient\Objects\Category::class,
        'channel'               => \GlimeshClient\Objects\Channel::class,
        'chatmessage'           => \GlimeshClient\Objects\ChatMessage::class,
        'chatMessage'           => \GlimeshClient\Objects\ChatMessage::class,
        'metadata'              => \GlimeshClient\Objects\StreamMetadata::class,
        'moderationlog'         => \GlimeshClient\Objects\ChannelModerationLog::class,
        'moderator'             => \GlimeshClient\Objects\ChannelModerator::class,
        'socials'               => \GlimeshClient\Objects\UserSocial::class,
        'socials'               => \GlimeshClient\Objects\UserSocial::class,
        'stream'                => \GlimeshClient\Objects\Stream::class,
        'streamer'              => \GlimeshClient\Objects\User::class,
        'subcategory'           => \GlimeshClient\Objects\Subcategory::class,
        'subscription'          => \GlimeshClient\Objects\Sub::class,
        'tag'                   => \GlimeshClient\Objects\Tag::class,
        'token'                 => \GlimeshClient\Interfaces\ChatMessageToken::class,
        'user'                  => \GlimeshClient\Objects\User::class,
        'status'                => \GlimeshClient\Objects\Enums\ChannelStatus::class,
        'channelstatus'         => \GlimeshClient\Objects\Enums\ChannelStatus::class,
        'RootMutationType'      => \GlimeshClient\Objects\RootMutationType::class,
        'RootSubscriptionType'  => \GlimeshClient\Objects\RootSubscriptionType::class,
        'RootQueryType'         => \GlimeshClient\Objects\RootQueryType::class,
    ];

    /**
     * Returns an object based on the key and data. If an array of objects, returns \ArrayObject
     *
     * @param string $key  key given by API results
     * @param array  $data data of object
     *
     * @return AbstractObjectModel|ArrayObject
     */
    protected static function getObject(string $key, array $data = []): object
    {
        $class = self::resolveObjectKey($key);

        if ($class === null) {
            throw new \Exception('Class not implemented for ' . $key);
        }
        if (self::isArrayOfObjects($key)) {
            $return = [];

            foreach ($data as $itemKey => $item) {
                $return[$itemKey] = new $class($item);
            }

            return new \ArrayObject($return);
        } else {
            if (enum_exists($class)) {
                return $class::from($data[0]);
            }

            return new $class($data);
        }
    }

    /**
     * Is this a Date Field?
     */
    protected static function isDateField(string $value): bool
    {
        return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $value);
    }

    /**
     * Should this key be an array or a single object
     */
    protected static function isArrayOfObjects(string $key): bool
    {
        return isset(self::$mappingMulitple[$key]);
    }

    /**
     * Return class for key
     */
    protected static function resolveObjectKey(string $key): ?string
    {
        if (self::isArrayOfObjects($key)) {
            return self::$mappingMulitple[$key];
        }

        if (isset(self::$mappingSingle[$key])) {
            return self::$mappingSingle[$key];
        }

        return null;
    }
}
