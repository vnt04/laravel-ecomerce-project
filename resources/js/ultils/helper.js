export const formatDate = (dateString) => {
  const date = new Date(dateString);
  return date.toLocaleString("vi-VN", {
    day: "2-digit",
    month: "2-digit",
    year: "numeric",
    hour: "2-digit",
    minute: "2-digit",
  });
};

export const statusTagType = (status) => {
  switch (status) {
    case "confirmed":
      return "success";
    case "canceled":
      return "danger";
    case "pending":
      return "warning";
    default:
      return "";
  }
}