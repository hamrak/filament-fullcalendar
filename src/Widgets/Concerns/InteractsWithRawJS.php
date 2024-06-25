<?php

namespace Saade\FilamentFullCalendar\Widgets\Concerns;

trait InteractsWithRawJS
{
    /**
     * A ClassName Input for adding classNames to the outermost event element.
     * If supplied as a callback function, it is called every time the associated event data changes.
     *
     * @see https://fullcalendar.io/docs/event-render-hooks
     *
     * @return string
     */
    public function eventClassNames(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * A Content Injection Input. Generated content is inserted inside the inner-most wrapper of the event element.
     * If supplied as a callback function, it is called every time the associated event data changes.
     *
     * @see https://fullcalendar.io/docs/event-render-hooks
     *
     * @return string
     */
    public function eventContent(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * Called right after the element has been added to the DOM. If the event data changes, this is NOT called again.
     *
     * @see https://fullcalendar.io/docs/event-render-hooks
     *
     * @return string
     */
    public function eventDidMount(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * Called right before the element will be removed from the DOM.
     *
     * @see https://fullcalendar.io/docs/event-render-hooks
     *
     * @return string
     */
    public function eventWillUnmount(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * A ClassName Input for adding classNames to the outermost resource label element.
     * If supplied as a callback function, it is called every time the associated resource label data changes.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLabelClassNames(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * A Content Injection Input. Generated content is inserted inside the inner-most wrapper of the resource label element.
     * If supplied as a callback function, it is called every time the associated resource label data changes.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLabelContent(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * Called right before the resource label will be addedd from the DOM.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLabelDidMount(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * Called right before the resource label will be removed from the DOM.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLabelWillUnmount(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * A ClassName Input for adding classNames to the outermost resource lane element.
     * If supplied as a callback function, it is called every time the associated resource lane data changes.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLaneClassNames(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * A Content Injection Input. Generated content is inserted inside the inner-most wrapper of the resource lane element.
     * If supplied as a callback function, it is called every time the associated resource lane data changes.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLaneContent(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * Called right before the resource lane will be addedd from the DOM.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLaneDidMount(): string
    {
        return <<<JS
            null
        JS;
    }

    /**
     * Called right before the resource lane will be removed from the DOM.
     *
     * @see https://fullcalendar.io/docs/resource-render-hooks
     *
     * @return string
     */
    public function resourceLaneWillUnmount(): string
    {
        return <<<JS
            null
        JS;
    }
}
