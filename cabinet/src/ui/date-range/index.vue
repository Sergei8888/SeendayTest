<template>
  <VueDatePicker
    v-model="dateRange"
    locale="ru"
    :format="format"
    range
    placeholder="Выберите диапазон дат"
    select-text="Выбрать"
    cancel-text="Закрыть"
  />
</template>

<script setup>
import VueDatePicker from "@vuepic/vue-datepicker";
import "@vuepic/vue-datepicker/dist/main.css";

const emit = defineEmits(["change"]);

const props = defineProps({
  date: {
    type: Object,
    default() {
      return {};
    }
  }
});

const dateRange = computed({
  get() {
    return formatDateRange(props.date);
  },
  set(newValue) {
    handleDate(newValue);
  }
});


function formatDateRange(dateRangeFilter) {
  const range = [];

  if (dateRangeFilter?.date_start) {
    range.push(new Date(dateRangeFilter.date_start * 1000));
  }

  if (dateRangeFilter?.date_finish) {
    range.push(new Date(dateRangeFilter.date_finish * 1000));
  }

  return range;
}

// Получать дату в формате д.м.г, ч:м
const getDate = date => {
  const day = date.getDate();
  const month = date.getMonth() + 1;
  const year = date.getFullYear();

  const hour = date.getHours();
  const minutes = date.getMinutes().toString().padStart(2, "0");

  return `${day}.${month}.${year}, ${hour}:${minutes}`;
};

// формат для даты в инпуте
const format = date => {
  let stringDate = "";

  stringDate = getDate(date[0]);

  if (date[1]) {
    stringDate += ` - ${getDate(date[1])}`;
  }

  return stringDate;
};

// метод получения измененной даты
// Переводим в unixTime
const handleDate = date => {
  let formatRange = {};

  if (date) {
    formatRange = {
      date_start: Date.parse(date[0]) / 1000
    };

    if (date[1]) {
      formatRange.date_finish = Date.parse(date[1]) / 1000;
    }
  }

  emit("change", formatRange);
};
</script>
