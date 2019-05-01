<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Autopilot\V1\Assistant\Task;

use Twilio\ListResource;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class TaskStatisticsList extends ListResource {
    /**
     * Construct the TaskStatisticsList
     * 
     * @param Version $version Version that contains the resource
     * @param string $assistantSid The SID of the Assistant that is the parent of
     *                             the Task associated with the resource
     * @param string $taskSid The SID of the Task for which the statistics were
     *                        collected
     * @return \Twilio\Rest\Autopilot\V1\Assistant\Task\TaskStatisticsList 
     */
    public function __construct(Version $version, $assistantSid, $taskSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('assistantSid' => $assistantSid, 'taskSid' => $taskSid, );
    }

    /**
     * Constructs a TaskStatisticsContext
     * 
     * @return \Twilio\Rest\Autopilot\V1\Assistant\Task\TaskStatisticsContext 
     */
    public function getContext() {
        return new TaskStatisticsContext(
            $this->version,
            $this->solution['assistantSid'],
            $this->solution['taskSid']
        );
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Autopilot.V1.TaskStatisticsList]';
    }
}