export default {
    props: ['value'],
    template: `<div>Coupon: <input type="text" :value="this.value" @input="$emit('input', $event.target.value)" /></div>`,
}
