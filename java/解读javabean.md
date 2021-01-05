```java
package com.example.demo.std;

import java.beans.BeanInfo;
import java.beans.Introspector;
import java.beans.PropertyDescriptor;

import com.example.demo.pritice.PencilBean;

import org.junit.jupiter.api.Test;

public class IntrospectorTest {
    
    @Test
    public void testPencilBeanClass() {
        PencilBean p = new PencilBean();
        p.setName("hell");
        p.setPrice(12.2);
        try {
            BeanInfo info = Introspector.getBeanInfo(p.getClass());
            for (PropertyDescriptor a : info.getPropertyDescriptors()) {
                System.out.println("----" + a.getName());
                System.out.println(a.getReadMethod());
                System.out.println(a.getWriteMethod());
                System.out.println(a.getPropertyType());
                System.out.println(a.getValue(a.getName()));
            }
        } catch (Exception e) {
            System.out.println(e.getMessage());
        }
    }
}

```

- 结果

```
----class
public final native java.lang.Class java.lang.Object.getClass()
null
class java.lang.Class
null
----name
public java.lang.String com.example.demo.pritice.PencilBean.getName()
public void com.example.demo.pritice.PencilBean.setName(java.lang.String)
class java.lang.String
null
----price
public double com.example.demo.pritice.PencilBean.getPrice()
public void com.example.demo.pritice.PencilBean.setPrice(double)
double
null

```

