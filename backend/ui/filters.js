import dayjs from "dayjs";

export default {
    capitalize(value) {
        let capitalized = []
        value.split(' ').forEach(word => {
            capitalized.push(
                word.charAt(0).toUpperCase() +
                word.slice(1).toLowerCase()
            )
        })
        return capitalized.join(' ')
    },
    niceDate(value) {
        if (!value) {
            return null;
        }

        return dayjs(String(value)).format(" MMMM DD YYYY");
    }
}
