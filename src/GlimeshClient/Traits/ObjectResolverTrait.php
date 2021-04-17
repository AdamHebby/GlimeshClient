<?php

namespace GlimeshClient\Traits;

use GlimeshClient\Objects\AbstractObjectModel;

/**
 * Trait for Resolving Glimesh Objects
 */
trait ObjectResolverTrait
{
    /**
     * keys that contain multiple objects, makes us return ObjectArray of this class
     *
     * @var array
     */
    public static $mappingMulitple = [
        'bans'           => \GlimeshClient\Objects\ChannelBan::class,
        'categories'     => \GlimeshClient\Objects\Category::class,
        'channels'       => \GlimeshClient\Objects\Channel::class,
        'chatMessages'   => \GlimeshClient\Objects\ChatMessage::class,
        'followers'      => \GlimeshClient\Objects\Follower::class,
        'following'      => \GlimeshClient\Objects\Follower::class,
        'moderationLogs' => \GlimeshClient\Objects\ChannelModerationLog::class,
        'moderators'     => \GlimeshClient\Objects\ChannelModerator::class,
        'subcategories'  => \GlimeshClient\Objects\Subcategory::class,
        'subscriptions'  => \GlimeshClient\Objects\Sub::class,
        'tags'           => \GlimeshClient\Objects\Tag::class,
        'users'          => \GlimeshClient\Objects\User::class,
        // 'tokens'        => \GlimeshClient\Objects\ChatMessageToken::class,
    ];

    /**
     * Single ojects
     *
     * @var array
     */
    public static $mappingSingle = [
        'ban'            => \GlimeshClient\Objects\ChannelBan::class,
        'category'       => \GlimeshClient\Objects\Category::class,
        'channel'        => \GlimeshClient\Objects\Channel::class,
        'chatMessage'    => \GlimeshClient\Objects\ChatMessage::class,
        'follower'       => \GlimeshClient\Objects\Follower::class,
        'metadata'       => \GlimeshClient\Objects\StreamMetadata::class,
        'moderationLog'  => \GlimeshClient\Objects\ChannelModerationLog::class,
        'moderator'      => \GlimeshClient\Objects\ChannelModerator::class,
        'socials'        => \GlimeshClient\Objects\UserSocial::class,
        'subcategory'    => \GlimeshClient\Objects\Subcategory::class,
        'subscription'   => \GlimeshClient\Objects\Sub::class,
        'tag'            => \GlimeshClient\Objects\Tag::class,
        'user'           => \GlimeshClient\Objects\User::class,
        // 'token'         => \GlimeshClient\Objects\ChatMessageToken::class,
    ];

    /**
     * Returns an object based on the key and data. If an array of objects, returns \ArrayObject
     *
     * @param string $key  key given by API results
     * @param array  $data data of object
     *
     * @return AbstractObjectModel|ArrayObject
     */
    public static function getObject(string $key, array $data): object
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
            return new $class($data);
        }
    }

    /**
     * Is this a Date Field?
     *
     * @param string $value
     *
     * @return boolean
     */
    public static function isDateField(string $value): bool
    {
        return preg_match('/^[0-9]{4}-[0-9]{2}-[0-9]{2}T[0-9]{2}:[0-9]{2}:[0-9]{2}$/', $value);
    }

    /**
     * Should this key be an array or a single object
     *
     * @param string $key
     *
     * @return boolean
     */
    public static function isArrayOfObjects(string $key): bool
    {
        return isset(self::$mappingMulitple[$key]);
    }

    /**
     * Return class for key
     *
     * @param string $key
     *
     * @return string|null
     */
    public static function resolveObjectKey(string $key): ?string
    {
        if (isset(self::$mappingMulitple[$key])) {
            return self::$mappingMulitple[$key];
        }

        if (isset(self::$mappingSingle[$key])) {
            return self::$mappingSingle[$key];
        }

        return null;
    }
}
