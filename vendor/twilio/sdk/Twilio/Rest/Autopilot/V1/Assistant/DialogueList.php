<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Autopilot\V1\Assistant;

use Twilio\ListResource;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class DialogueList extends ListResource {
    /**
     * Construct the DialogueList
     * 
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the Assistant that is the parent of
     *                             the resource
     * @return \Twilio\Rest\Autopilot\V1\Assistant\DialogueList 
     */
    public function __construct(Version $version, $assistantSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('assistantSid' => $assistantSid, );
    }

    /**
     * Constructs a DialogueContext
     * 
     * @param string $sid The unique string that identifies the resource
     * @return \Twilio\Rest\Autopilot\V1\Assistant\DialogueContext 
     */
    public function getContext($sid) {
        return new DialogueContext($this->version, $this->solution['assistantSid'], $sid);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Autopilot.V1.DialogueList]';
    }
}