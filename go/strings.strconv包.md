
#### strings package

- strings.HasPrefix(s, prefix string) bool
- strings.HasSuffix(s, suffix string) bool
- strings.Contains(s, substr string) bool
- strings.Index(s, str string) int
- strings.LastIndex(s, str string) int
- strings.IndexRune(s string, r rune) int (如果需要查询非 ASCII 编码的字符在父字符串中的位置，建议使用以下函数来对字符进行定位：)
- strings.Replace(str, old, new, n) string （-1 全部替换）
- strings.Count(s, str string) int (非重叠次数)
- strings.Repeat(s, count int) string
- strings.ToLower(s) string
- strings.ToUpper(s) string
- strings.TrimSpace(s) /TrimLeft TrimRight
###### 分割拼接
- strings.Fields(s)
- strings.Split(s, sep)
- strings.Join(sl []string, sep string) string

#### strconv package
（任何类型 T 转换为字符串总是成功的。）
error)
- strconv.IntSize() int

- strconv.Itoa(i int) string
- strconv.FormatFloat(f float64, fmt byte, prec int, bitSize int) string

/

- strconv.Atoi(s string) (i int, err error)
- strconv.ParseFloat(s string, bitSize int) (f float64, err 
